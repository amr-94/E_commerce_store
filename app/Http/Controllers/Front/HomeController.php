<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $products = Product::where('status', 'active')->with('category')->latest()->limit(10)->get();
        // $categories = Category::all();
        // if($products->compare_price){
        //     $p_compare = 100 - (100 * $products->price / $products->compare_price);
        // }
        return view("Front.home", compact("products"));
    }


    public function markasread($id)
    {
        $user = Auth::user();
        $user->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->back();
    }
}
