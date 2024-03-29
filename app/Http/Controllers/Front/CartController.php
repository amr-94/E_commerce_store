<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repo\Cart\CartModelRepo;
use App\Repo\Cart\CartRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepo $cart)
    {
        // $repo = App::make('cart');




        return view('Front.cart', [
            'cart' => $cart,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartRepo $cart)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantaty' => ['nullable', 'integer', 'min:1'],
        ]);
        $product = Product::find($request->post('product_id'));
        $cart->add($product, $request->post('quantity', 'user_id'));
        return redirect(route('cart.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartRepo $cart, string $id)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantaty' => ['nullable', 'integer', 'min:1'],
        ]);
        $product = Product::find($request->post('product_id'));
        $cart->update($product, $request->post('quantaty'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepo $cart, string $id)
    {
        $cart->delete($id);
        return redirect(route('cart.index'));
    }
}
