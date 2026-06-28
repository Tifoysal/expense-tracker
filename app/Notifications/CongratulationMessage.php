<?php

namespace App\Notifications;

use App\Models\User;
use App\Traits\GetNotificationChannelTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class CongratulationMessage extends Notification implements ShouldQueue
{
    use Queueable;
    use GetNotificationChannelTrait;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->getNotificationChannel($notifiable);

    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Dear ' . $this->user->first_name)
            ->line('Warmest congratulations on your achievement! Wishing you even more success in the future.');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'opportunity_id'             => null,
            'title'             => 'Congratulation your membership have been promoted',
            'status'            => $this->user->membership->name,
            'sender_id'         => $this->user->id,
            'sender_name'       => $this->user->first_name,
            'sender_image'      => $this->user->image,
            'sender_uid'        => $this->user->uid,
            'is_online'         => Cache::has('user-is-online-' .$this->user->id),
        ];
    }

    public function getRole()
    {
        return $this->user->role;
    }

    public function toArray($notifiable)
    {
        return [

        ];
    }
}
