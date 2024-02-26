<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialiteController extends Controller
{
    public function signInWithGoogle()
    {
        session(['login' => true]);
        return Socialite::driver('google')->redirect();
    }

    public function signInWithGoogleSeeker()
    {
        session(['practitioner' => false]);
        return Socialite::driver('google')->redirect();
    }

    public function signInWithGooglePractitioner()
    {
        session(['practitioner' => true]);
        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $err) {
            return to_route('login')->withErrors([
                'callback' => 'Could not register with your google account, try again later or check your account details are correct',
            ]);
        }

        $user = User::where('email', $googleUser->email)->first();

        if ($user && !session()->has('login')) {
            return to_route('login')->withErrors([
                'email' => 'The credentials provided already match our records.',
            ])->onlyInput('email');
        }

        if (session()->has('practitioner') && !session()->get('practitioner')) {

            return view('front.forms.create-seeker')->with(['seeker' => $googleUser, 'countries' => Country::all()]);
        }

        if (session()->has('practitioner') && session()->get('practitioner')) {
            return view('front.forms.register-facilitator')->with(['practitioner' => $googleUser, 'countries' => Country::all(), 'languages' => Language::all(), 'categories' => Category::all()]);
        }

        session()->flush();
        if (!$user) {
            return to_route('login')->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        Auth::login($user);
        return to_route('home');
    }
}
