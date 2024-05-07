<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrederCreatedNotification extends Notification
{
    use Queueable;
    protected $order;
    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $adder = $this->order->billingAdress;

        return (new MailMessage)
            ->subject('New Order #' . $this->order->number)
            ->greeting('Hello ' . $adder->first_name)
            ->line("A New order (#{$this->order->number}) created by {$adder->first_name} ")
            ->action('View order', url('/dashboard'))
            ->line('Thank you for using our application!');
        // ->view('') to return custome view
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        $adder = $this->order->billingAdress;
        return [
            'body' => "A New order (#{$this->order->number}) created by {$adder->first_name}",
            'url' => url('/dashboard'),
            // 'order_user' => route('/'),
            'order_id' => $this->order->id,
        ];
    }

    public function toBroadcast(object $notifiable): array
    {
        $adder = $this->order->billingAdress;
        return  [
            'body' => "A New order (#{$this->order->number}) created by {$adder->first_name}",
            'url' => url('/dashboard'),
            // 'order_user' => route('/'),
            'order_id' => $this->order->id,
        ];
    }



    public function toArray(object $notifiable): array
    {
        $adder = $this->order->billingAdress;

        return [
            //
        ];
    }
}