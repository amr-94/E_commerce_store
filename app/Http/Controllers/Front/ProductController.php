<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('Front.productshow', compact('product'));
    }
}