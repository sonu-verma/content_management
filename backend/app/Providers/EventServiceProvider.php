<?php

namespace App\Providers;

use App\Listeners\Users\CreateUserChannel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
// use Illuminate\Support\ServiceProvider;
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
            CreateUserChannel::class,
        ],
    ];
}
