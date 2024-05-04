<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $products = Product::where('status', 'active')->with('category')->latest()->limit(10)->get();
        // if($products->compare_price){
        //     $p_compare = 100 - (100 * $products->price / $products->compare_price);
        // }
        return view("Front.home", compact("products"));
    }
}
