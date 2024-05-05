<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Models\User;
use App\Notifications\OrederCreatedNotification;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreate $event): void
    {
        $order = $event->order;
        $user = User::where('store_id', $order->store_id)->first();
        $user->notify(new OrederCreatedNotification($order));
        $admin = User::where('type', 'admin')->first();
        $admin->notify(new OrederCreatedNotification($order));
    }
}
