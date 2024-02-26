<?php

namespace App\Providers;

use App\Models\Content;
use App\Models\Service;
use App\Models\Order;
use App\Models\Post;
use App\Models\Purchase;
use App\Models\Recurrence;
use App\Models\Subcategory;
use App\Models\User;
use App\Observers\ContentObserver;
use App\Observers\ServiceObserver;
use App\Observers\SubcategoryObserver;
use App\Observers\OrderObserver;
use App\Observers\PostObserver;
use App\Observers\PurchaseObserver;
use App\Observers\RecurrenceObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Subcategory::class => [SubcategoryObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Service::observe(ServiceObserver::class);
        Content::observe(ContentObserver::class);
        Order::observe(OrderObserver::class);
        Purchase::observe(PurchaseObserver::class);
        Post::observe(PostObserver::class);
        User::observe(UserObserver::class);
        Recurrence::observe(RecurrenceObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
