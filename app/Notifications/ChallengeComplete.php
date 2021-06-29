<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChallengeComplete extends Notification
{
    use Queueable;
    private $challengeData;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($challengeData)
    {
        echo(0);
        $this->challengeData = $challengeData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        echo(1);
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
        echo(2);
        return (new MailMessage)
            ->line($this->challengeData['name'])
            ->line($this->challengeData['body']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        echo(3);
        return [
            'challenge_ID'=>$this->challengeData['challenge_ID']
        ];
    }
}
