<?php

namespace App\Providers;

use App\Events\BookingCreated;
use App\Events\BookingCanceled;
use App\Listeners\SendBookingCreatedNotification;
use App\Listeners\SendBookingCanceledNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BookingCreated::class => [
            SendBookingCreatedNotification::class,
        ],
        BookingCanceled::class => [
            SendBookingCanceledNotification::class,
        ],
    ];
}
