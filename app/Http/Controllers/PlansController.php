<?php

namespace App\Http\Controllers;

use App\Enums\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PlansController extends Controller
{
    public function index()
    {
        return view('front.plans.index');
    }

    public function checkoutWebhook(Request $request)
    {
        $payload = $request['data']['object'];
        if($this->subscription($payload)) {
            return response()->json(['success' => true]);
        }
    }

    private function subscription($payload)
    {
        if($payload['object'] === 'subscription') {
            $subscription = Subscription::where('subscription_id', $payload['id'])->first();
            if (!$subscription) {
                $subscription = new Subscription();
            }
            $subscription->subscription_id = $payload['id'];
            $subscription->product_id = $payload['plan']['product'];
            $subscription->plan = Plan::findByStripeId($subscription->product_id);
            $subscription->currency = $payload['currency'];
            $subscription->payment_status = $payload['status'];
            return $subscription->save();
        }

        if($payload['object'] === 'checkout.session') {
            $subscription = self::verifySubscription($payload['subscription'], $payload['id']);
            if ($payload['status'] == 'complete') {
                $userId = $payload['client_reference_id'];
                $user = User::find($userId);
                if(!$user) $user = User::where('email', $payload['customer_details']['email'])->first();

                if ($subscription) {
                    if ($user) {
                        $userSubscription = new UserSubscription([
                            'subscription_id' => $subscription->id,
                        ]);
            
                        $user->userSubscription()->save($userSubscription);
                    }
                    
                    return true;
                }
            }
            return false;
        }
    }
    
    public function updateWebhook(Request $request)
    {
        $payload = $request['data']['object'];
        if($this->update($payload)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    private function update($payload)
    {
        if($payload['object'] === 'subscription') {
            $plan = $payload['items']['data'][0]['plan'];
            $subscription = Subscription::where('subscription_id', $payload['id'])->first();
            if ($subscription) {
                $subscription->payment_status = $payload['status'];
                $subscription->product_id = $plan['product'];
                $subscription->currency = $plan['currency'];
                $subscription->plan = Plan::findByStripeId($subscription->product_id);
                return $subscription->save();
            }

            $subscription = new Subscription();
            $subscription->subscription_id = $payload['id'];
            $subscription->product_id = $plan['product'];
            $subscription->plan = Plan::findByStripeId($subscription->product_id);
            $subscription->currency = $plan['currency'];
            $subscription->payment_status = $payload['status'];
            return $subscription->save();
        }
        return false;
    }

    public function cancelWebhook(Request $request)
    {
        $payload = $request['data']['object'];
        if($this->cancel($payload)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    private function cancel($payload)
    {
        if($payload['object'] === 'subscription') {
            $subscription = Subscription::where('subscription_id', $payload['id'])->first();
            if ($subscription) {
                $subscription->payment_status = $payload['status'];
                $canceledAtTimestamp = now()->timestamp;
                $subscription->canceled_at = Carbon::createFromTimestamp($canceledAtTimestamp);
                $subscription->save();
                $subscription->userSubscription->delete();
                $subscription->delete();
                return true;
            }
        }
        return false;
    }

    protected function verifySubscription($id, $checkoutId = null)
    {
        $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SECRET_KEY']);
        $subscriptionStripe = $stripe->subscriptions->retrieve($id, []);

        if($checkoutId){ 
            $checkout = $stripe->checkout->sessions->retrieve($checkoutId, []);
            $subscription = Subscription::where('subscription_id', $subscriptionStripe->id)->first();
            if(!$subscription) {
                $subscription = new Subscription();
                $subscription->subscription_id = $subscriptionStripe->id;
                $subscription->product_id = $subscriptionStripe->plan->product;
                $subscription->plan = Plan::findByStripeId($subscription->product_id);
                $subscription->currency = $subscriptionStripe->plan->currency;
                $subscription->payment_status = $subscriptionStripe->status;
            }
            
            $subscription->email = $checkout->customer_details->email;
            $subscription->name = $checkout->customer_details->name;
            $subscription->canceled_at = null;
            $subscription->save();
            return $subscription;
        }

    }
}
