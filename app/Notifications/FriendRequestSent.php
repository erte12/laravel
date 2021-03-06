<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FriendRequestSent extends Notification
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
        return ['mail', 'database'];
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
                    ->line('Dostałeś zaproszenie do znajomych!')
                    ->action('Odwiedź profil użytkownika', url('users/' . auth()->id()));
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
            $message = 'Masz zaproszenie od użytkownika <a href="' . $url . '">'. auth()->user()->name .'</a>!';
        } elseif (auth()->user()->sex === 'f') {
            $message = 'Masz zaproszenie od użytkowniczki <a href="' . $url . '">'. auth()->user()->name .'</a>!';
        }

        return [
            'message' => $message,
        ];
    }
}
