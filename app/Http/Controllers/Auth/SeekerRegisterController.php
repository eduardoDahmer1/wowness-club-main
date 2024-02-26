<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Order;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class SeekerRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        session()->forget('practitioner');
        return view('front.forms.create-seeker', [
            'countries' => Country::all(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:255'],
            'photo' => 'nullable|image|max:2048',
            'terms' => 'required',
            'city' => ['nullable', 'string', 'max:255'],
            'country_id' => ['required', 'exists:countries,id'],
            'google_id' => ['nullable', 'string'],
            'google_token' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => Role::CommonUser->value,
            'city' => $request->city,
            'country_id' => $request->country_id,
            'google_id' => $request->google_id,
            'google_token' => $request->google_token
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $user->photo = $path;
            $user->save();
        }

        Auth::login($user);
        event(new Registered(Auth::user()));

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

        return to_route('verification.notice');
    }

    public function edit(User $seeker)
    {
        $this->authorize('update', $seeker);

        return view('front.orders.edit', [
            'seeker' => $seeker,
            'countries' => Country::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, User $seeker)
    {
        $this->authorize('update', $seeker);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'street' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:255'],
            'country_id' => ['exists:countries,id'],
        ]);

        if ($request->photo) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = $path;
        }

        if ($request->photo && $seeker->photo) {
            Storage::disk('public')->delete($seeker->photo);
        }

        $seeker->update($data);

        return to_route('orders.indexSeeker');
    }
}
