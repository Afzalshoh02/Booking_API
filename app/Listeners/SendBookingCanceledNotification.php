<?php

namespace App\Listeners;

use App\Events\BookingCanceled;
use App\Notifications\BookingCanceledNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendBookingCanceledNotification
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
    public function handle(BookingCanceled $event): void
    {
        $user = $event->booking->user;
        if ($user) {
            $user->notify(new BookingCanceledNotification($event->booking));
        } else {
            Log::warning('User not found for booking cancellation: ' . $event->booking->id);
        }
    }
}
