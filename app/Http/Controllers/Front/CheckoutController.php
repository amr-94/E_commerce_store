<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreate;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repo\Cart\CartRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepo $cart)
    {
        if ($cart->get()->count() == 0) {
            return redirect()->route('home');
        }
        return view('Front.checkout', [
            'cart' => $cart
        ]);
    }

    public function store(Request $request, CartRepo $cart)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'phone' => 'required',
        //     'street_address' => 'required',
        //     'city' => 'required',
        // ]);
        $items = $cart->get()->groupBy('product.store_id')->all();
        // dd($request);

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => auth()->user()->id,
                    'payment_method' => 'cod',
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);
                    foreach ($request->post('adder') as $type => $addresses) {
                        $addresses['type'] = $type;
                        $order->addresses()->create($addresses);
                    }
                }
            }
            // $cart->empty(); will move it to listienr
            DB::commit();
            // event('order_created', $order, $cart);
            event(new OrderCreate($order));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('cart.index')->with('success', 'Your order has been placed successfully');
    }
}
