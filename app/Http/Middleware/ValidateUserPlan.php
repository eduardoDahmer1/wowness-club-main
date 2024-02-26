<?php

namespace App\Http\Middleware;

use App\Enums\Plan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateUserPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            abort(403);
        }

        if(Auth::user()->isAdmin()){
            return $next($request);
        }

        if(!isset(Auth::user()->subscription->plan) ||  Auth::user()->subscription->plan === Plan::Free){
            $errors['plan'] = ['Unlock Premium Features. Upgrade Now!'];
            return redirect()->route('upgrade')->withErrors($errors);
        }

        return $next($request);
    }
}
