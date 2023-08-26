<?php

namespace App\Notifications;

use App\Models\Order;
use App\Enums\General\Order\OrderTypes;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $user;
    protected $content;
    public function __construct(User $user,array $content)
    {
        $this->user=$user;
        $this->content=$content;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('OFFERS! have a look now');
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

    public function toDatabase(object $notifiable):array
    {
        $arr=array_merge(
            $this->content,
            [
                'model_id' => $this->user->id,
                'type' => 'new_offer'
            ]);
        send_fcm_notification($notifiable,$arr);
        return $arr;
    }
}
