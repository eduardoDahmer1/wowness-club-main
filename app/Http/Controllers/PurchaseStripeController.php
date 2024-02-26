<?php

namespace App\Http\Controllers;

use App\Enums\Plan;
use App\Models\Purchase;
use Error;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseStripeController extends Controller
{
    public function index(Purchase $purchase)
    {
        if (auth()->user()->id !== $purchase->user_id) {
            abort(403);
        }

        $percentTax = 0.015;
        $fixedFee = 0.20;

        $netValue = ($purchase->content->price * $purchase->quantity + $fixedFee) / (1 - $percentTax);
        $fee = $netValue - ($purchase->content->price * $purchase->quantity);
        $fee = number_format($fee, 2, '.', '');
        $netValue = number_format($netValue, 2, '.', '');

        return view('front.purchases.checkout.index', compact('purchase', 'fee', 'netValue'));
    }

    public function createPaymentIntent(Purchase $purchase)
    {
        header('Content-Type: application/json');

        try {
            $fee = isset($purchase->content->user->subscription->plan) ? $purchase->content->user->subscription->plan->contentFee() : Plan::Free->contentFee();
            $applicationFee = ($purchase->content->price * 100) * $purchase->quantity * $fee;

            $facilitatorStripeId = $purchase->content->user->stripe_id;

            $percentTax = 0.015;
            $fixedFee = 20;

            $netValue = ($purchase->content->price * 100 * $purchase->quantity + $fixedFee) / (1 - $percentTax);
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

            $purchase->payment_intent = $paymentIntent->id;
            $purchase->save();

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
