<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Pusher\Pusher;

class SkilzatNotification extends Notification
{
    use Queueable;

    public $message_ar;
    public $message_en;
    public $type;
    public $link;
    public $name;
    public $order;

    public function __construct($message_ar, $message_en, $type, $link, $name)
    {
        $this->message_ar = $message_ar;
        $this->message_en = $message_en;
        $this->type = $type;
        $this->link = $link;
        $this->name = $name;
       
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message_ar,
            'message_en' => $this->message_en,
            'type' => $this->type,
            'link' => $this->link,
            'name' => $this->name,
            
        ];
    }
}
