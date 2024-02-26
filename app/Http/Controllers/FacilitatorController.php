<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacilitatorRequest;
use App\Mail\PendingApproval;
use App\Models\Certificate;
use App\Models\Country;
use App\Models\Order;
use App\Models\Language;
use App\Models\Purchase;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class FacilitatorController extends Controller
{
    public function create()
    {
        session()->forget('practitioner');
        return view('front.forms.register-facilitator', [
            'countries' => Country::all(),
            'languages' => Language::all(),
            'categories' => Category::all(),
            'subcategories' => Subcategory::all()
        ]);
    }

    public function store(StoreFacilitatorRequest $request)
    {

        $data = $request->validated();

        if ($request->photo) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = $path;
        }


        $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SECRET_KEY']);
        $facilitatorStripe = $stripe->accounts->create([
            'type' => 'standard',
        ]);

        $data['stripe_id'] = $facilitatorStripe->id;


        $user = User::create($data);

        collect($data['specialisations'] ?? [])->each(fn ($specialisation) => !empty($specialisation['name']) ? $user->specialisations()->create($specialisation) : true);
        collect($data['testimonials'] ?? [])->each(fn ($testimonial) => !empty($testimonial['name']) ? $user->testimonials()->create($testimonial) : true);

        $user->categoriesuser()->sync(collect($data['categories'] ?? [])->pluck('id'));
        $user->subcategoriesuser()->sync(collect($data['subcategories'] ?? [])->pluck('id'));
        $user->languages()->sync(collect($data['languages'] ?? [])->pluck('id'));

        if ($request->certificates) {
            foreach ($request->file('certificates') as $certificate) {
                $path = $certificate->store('certificates', 'public');
                Certificate::create([
                    'user_id' => $user->id,
                    'file' => $path
                ]);
            }
        }

        Auth::login($user, true);
        Mail::to($request->user())->send(new PendingApproval($user));
        event(new Registered($user));

        if (Session::has('order')) {
            $orderData = Session::get('order');
            $package = Session::get('package');

            if (!$package->service->user->status_stripe_integration) {
                return redirect()->route('services.show', $package->service)->withErrors(['quantity' => __('The Practitioner must be verify account on stripe to sell')]);
            }

            if ($package->quantity < $orderData['quantity']) {
                return redirect()->route('services.show', $package->service)->withErrors(['quantity' => __('The quantity must be lower than the number of services available')]);
            }

            $timezoneService = $package->service->timezone->timezone;

            if ($package->service->end->shiftTimezone($timezoneService) < now($timezoneService)) {
                return redirect()->route('services.show', $package->service)->withErrors(['date' => __('This service has already expired.')]);
            }

            $orderData['user_id'] = auth()->user()->id;
            $order = Order::create($orderData);
            $package->quantity -= $order->quantity;
            $package->save();
            Session::forget('order');
            Session::forget('package');

            return to_route('checkout.index', ['order' => $order->id]);
        }

        if (Session::has('purchase')) {
            $purchaseData = Session::get('purchase');

            if (!$purchaseData->content->user->status_stripe_integration) {
                return redirect()->route('contents.show', $purchaseData->content)->withErrors(['quantity' => __('The Practitioner must be verify account on stripe to sell')]);
            }

            $purchaseData['user_id'] = auth()->user()->id;
            $purchase = Purchase::create($purchaseData);
            Session::forget('purchase');

            return to_route('front.purchases.checkout.index', ['purchase' => $purchase->id]);
        }

        return redirect()->route('success.register');
    }
}
