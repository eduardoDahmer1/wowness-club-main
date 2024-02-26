<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Mail\ConfirmMail;
use App\Models\Purchase;
use App\Models\Service;
use App\Notifications\VerifyEmail;
use App\Policies\ContentPolicy;
use App\Policies\PurchasePolicy;
use App\Policies\ServicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Category' => 'App\Policies\CategoriesPolicy',
        'App\Models\Subcategory' => 'App\Policies\SubcategoriesPolicy',
        Service::class => ServicePolicy::class,
        Content::class => ContentPolicy::class,
        Purchase::class => PurchasePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new ConfirmMail(Str::words($notifiable->name, 1, ' '), $url, $notifiable->email))->to($notifiable);
        });
    }
}
