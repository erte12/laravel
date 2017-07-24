<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FriendRequestAccepted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $url = url('users/' . auth()->id());
        if(auth()->user()->sex === 'm') {
            $message = 'Użytkownik <a href="' . $url . '">'. auth()->user()->name .'</a> przyjął Twoje zaproszenie!';
        } elseif (auth()->user()->sex === 'f') {
            $message = 'Użytkowniczka <a href="' . $url . '">'. auth()->user()->name .'</a> przyjęła Twoje zaproszenie!';
        }

        return [
            'message' => $message,
        ];
    }
}
