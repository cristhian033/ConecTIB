<?php

namespace App\Providers;

use App\Events\UserCreate;
use App\Events\UserDelete;
use App\Events\UserUpdated;
use App\Listeners\LogUserCreate;
use App\Listeners\LogUserDelete;
use App\Listeners\LogUserUpdate;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        UserUpdated::class => [
            LogUserUpdate::class,
        ],
        UserCreate::class => [
            LogUserCreate::class,
        ],
        UserDelete::class => [
            LogUserDelete::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
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
