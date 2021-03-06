<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class PostCommented extends Notification
{
    use Queueable;
    protected $user_id;
    protected $comment_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_id, $comment_id)
    {
        $this->user_id = $user_id;
        $this->comment_id = $comment_id;
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
        $user_link = '<a href="' . url('users/' . Auth::id()) . '">' . Auth::user()->name . '</a>';
        $comment_link = '<a href="' . url('users/' . $this->user_id . '#comment_id' . $this->comment_id) . '">Twój post</a>';

        return [
            'message' => 'Użytkownik ' . $user_link . ' skomentował ' . $comment_link,
        ];
    }
}
