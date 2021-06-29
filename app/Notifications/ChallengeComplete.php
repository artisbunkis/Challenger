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
    public function __construct($challenge)
    {
        echo($challenge);
        $this->challenge = $challenge;
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

        return (new MailMessage)
            ->greeting('You have created a new challenge!')
            ->line('Congradulations, you just created a new challenge with name "'.$this->challenge->challengeName.'"')
            ->line('We hope you will finish the challenge till '.$this->challenge->endDate)
            ->line('')
            ->line('Good Luck!');
        
    }

    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // echo(3);
        return [
            'challenge_ID'=>$this->challenge->challenge_ID
        ];
        return;
    }
}
