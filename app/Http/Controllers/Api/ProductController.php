<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Pest\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return Product::Filtter($request->query())->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string'],
            'des' => ['required', 'string'],
            'category_id' => ['required', 'exists:category,id'],
        ]);

        $product = Product::create($request->all());
        return Response::json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $request->merge([
            // 'user_id' => Auth::user()->id,
            // 'slug' => Str::slug($request->name),
            // 'store_id' =>  Auth::user()->store_id,

        ]);
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = product::find($id);
        $product->delete($id);
        return $product;
    }
}
