<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class BookingCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $booking;
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject('Booking Confirmation')
            ->line('Your booking has been successfully created!')
            ->line('Booking ID: ' . $this->booking->id)  // ID бронирования
            ->line('Booking Date: ' . $this->booking->created_at->format('Y-m-d H:i'))
            ->action('View Booking', url('/bookings/' . $this->booking->id))
            ->line('Thank you for using our application!');

        Log::channel('mail')->info('Sending booking created email to: ' . $notifiable->email, [
            'booking_id' => $this->booking->id,
            'booking_date' => $this->booking->created_at,
            'email_subject' => 'Booking Confirmation',
        ]);

        // Возвращаем письмо для отправки
        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
