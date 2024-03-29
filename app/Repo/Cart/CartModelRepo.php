<?php

namespace App\Repo\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepo implements CartRepo
{
    public function get(): Collection
    {
        return Cart::with('product')->where('user_id', Auth::user()->id)
            ->where('cookie_id', '=', $this->getCookieId())->get();
        dd($this->get());
    }

    public function add(Product $product, $quantity = 1)
    {

        $item = Cart::where('product_id', '=', $product->id)
            ->orWhere('user_id', Auth::user()->id)->first();
        if (!$item) {
            return  $cart = Cart::create([
                'cookie_id' => $this->getCookieId(),
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
            $this->get()->push($cart);
        }
        return $item->increment('quantity', $quantity);
    }
    public function update(Product $product, $quantity)
    {

        return Cart::where('product_id', '=', $product->id)
            ->where('cookie_id', $this->getCookieId())->update([
                'quantity' => $quantity
            ]);
    }
    public function delete($id)
    {
        Cart::where('product_id', '=', $id)
            ->where('cookie_id', $this->getCookieId())->delete();
    }

    public function empty()
    {
        cart::where('cookie_id')->destroy();
    }
    public function total(): float
    {

        return $this->get()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
    public function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = str::uuid();
            Cookie::queue('cart_id', $cookie_id, 60 * 24);
        }
        return $cookie_id;
    }
}
