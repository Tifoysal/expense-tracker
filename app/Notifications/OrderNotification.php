<?php

namespace App\Notifications;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public Customer $user;
    public Order $order;
    public function __construct(Order $order)
    {
        $this->user = $order->customer;
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            ->line('Hi ' . $this->order->user->name . ',')
            ->line('I hope you’re doing well!')
            ->action('View Order ','https://admin.unisonbd.com')
            ->line('You have successfully place and order # ' . $this->order->id .' due on ' . $this->order->created_at->format('Y-m-d'))
            ->line('Please let me know if you have any questions.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'order_id'             => $this->id,
            'title'             => 'Congratulation! Your order have been placed successfully.',
            'customer_id'         => $this->user->id,
        ];
    }
}
