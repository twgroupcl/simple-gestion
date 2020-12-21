<?php

namespace App\Providers;

use App\Events\InventoryUpdated;
use Illuminate\Auth\Events\Login;
use App\Listeners\CheckCriticalStock;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Registered;
use App\Listeners\AddToSessionAfterLogin;
use App\Listeners\AddToSessionBeforeLogin;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        Attempting::class => [
            AddToSessionBeforeLogin::class,
        ],

        Login::class => [
            AddToSessionAfterLogin::class,
        ],

        InventoryUpdated::class => [
            CheckCriticalStock::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
