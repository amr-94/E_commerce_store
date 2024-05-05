<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Throwable;

class DeductProductQuantity
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
        // dd($order->products);
        $order = $event->order;
        try {
            foreach ($order->products as $product) {
                $product->decrement('quantity', $product->pivot->quantity);
            }
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
