<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Notifications\BookingCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBookingCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingCreated $event): void
    {
        $event->booking->user->notify(new BookingCreatedNotification($event->booking));
    }
}
