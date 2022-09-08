<?php

declare(strict_types=1);

namespace Modules\Xot\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class Test1Notification.
 */
<<<<<<< HEAD
class Test1Notification extends Notification {
=======
class Test1Notification extends Notification
{
>>>>>>> 9472ad4 (first)
    use Queueable;

    /**
     * Create a new notification instance.
     */
<<<<<<< HEAD
    public function __construct() {
=======
    public function __construct()
    {
>>>>>>> 9472ad4 (first)
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
<<<<<<< HEAD
    public function via($notifiable) {
=======
    public function via($notifiable)
    {
>>>>>>> 9472ad4 (first)
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
<<<<<<< HEAD
    public function toMail($notifiable) {
=======
    public function toMail($notifiable)
    {
>>>>>>> 9472ad4 (first)
        return (new MailMessage())
            ->line('The introduction to the notification.')
            ->action('Notification Action', 'https://laravel.com')
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
<<<<<<< HEAD
    public function toArray($notifiable) {
=======
    public function toArray($notifiable)
    {
>>>>>>> 9472ad4 (first)
        return [
        ];
    }
}
