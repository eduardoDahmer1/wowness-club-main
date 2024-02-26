<?php

namespace App\Http\Controllers;

use App\Enums\Plan;
use App\Models\Order;
use Error;

class StripeController extends Controller
{

    public function index(Order $order)
    {
        if (auth()->user()->id !== $order->user_id) {
            abort(403);
        }

        $timezoneService = $order->package->service->timezone->timezone;

        if ($order->package->service->end->shiftTimezone($timezoneService) < now($timezoneService)) {
            return redirect()->route('orders.indexSeeker', $order->package->service)->withErrors(['date' => __('This service has already expired.')]);
        }

        $percentTax = 0.015;
        $fixedFee = 0.20;

        $netValue = ($order->package->price * $order->quantity + $fixedFee) / (1 - $percentTax);
        $fee = $netValue - ($order->package->price * $order->quantity);
        $fee = number_format($fee, 2, '.', '');
        $netValue = number_format($netValue, 2, '.', '');

        return view('front.checkout.index', compact('order', 'fee', 'netValue'));
    }

    public function createPaymentIntent(Order $order)
    {
        header('Content-Type: application/json');
 
        try {
            $fee = isset($order->package->service->user->subscription->plan) ? $order->package->service->user->subscription->plan->serviceFee() : Plan::Free->serviceFee();
            $applicationFee = ($order->package->price * 100) * $order->quantity * $fee;

            $facilitatorStripeId = $order->package->service->user->stripe_id;
            $percentTax = 0.015; 
            $fixedFee = 20;

            $netValue = ($order->package->price * 100 * $order->quantity + $fixedFee) / (1 - $percentTax);
            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create(
                [
                    'amount' => round($netValue),
                    'currency' => 'gbp',
                    'automatic_payment_methods' => ['enabled' => true],
                    'application_fee_amount' => $applicationFee,
                    'transfer_data[destination]' => $facilitatorStripeId,
                ],
            );

            $order->payment_intent = $paymentIntent->id;
            $order->save();
    
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            return json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function onboardingStatus()
    {
        if (!auth()->user()->stripe_id) {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
            $facilitatorStripe = $stripe->accounts->create(['type' => 'standard']);

            auth()->user()->stripe_id = $facilitatorStripe->id;
            auth()->user()->save();
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $onboarding = $stripe->accountLinks->create([
            'account' => auth()->user()->stripe_id,
            'refresh_url' => route('home'),
            'return_url' => route('change.status.stripe.integration'),
            'type' => 'account_onboarding',
        ]);

        return redirect()->away($onboarding->url);
    }

    public function stripeIntegration()
    {
        auth()->user()->status_stripe_integration = true;
        auth()->user()->save();

        return to_route('connections.index');
    }

}
