<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateIfServiceProvider
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

        if(Auth::user()->role->value == Role::CommonUser->value){
            abort(403);
        }

        if($request->route()->getName() != 'success.register') {
            if(Auth::user()->status == false && Auth::user()->role->value == Role::ServiceProvider->value){
                abort(401);
            }
        }

        return $next($request);
    }
}
