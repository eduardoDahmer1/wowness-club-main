<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Blade::if('isPractitioner', fn(User $user) => $user->isServiceProvider() || $user->isAdmin() || $user->isMaintainer());
        Blade::if('isMaintainer', fn(User $user) => $user->isAdmin() || $user->isMaintainer());
        Blade::if('isAdmin', fn(User $user) => $user->isAdmin());

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        if ($this->app->environment('production') || $this->app->environment('staging')) {
            URL::forceScheme('https');
        }
    }
}
