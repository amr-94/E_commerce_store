<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $request = request();
        $query = Product::query();
        $name = $request->name;
        $category = $request->category_id;
        if ($name !== null) {
            $query->where('name', 'like', "%$name%");
        } elseif ($category !== null) {
            $query->where('category_id', $category);
        }
        $products = $query->paginate(10);
        // $products = Product::where('name', 'like', "%$name%")
        //     ->where('category_id', $category)
        //     ->paginate(10);

        return view('Front.searchproduct', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('Front.productshow', compact('product'));
    }
}