<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $request = request();
        $query = Product::query();
        $name = $request->name;
        $status = $request->status;

        // $products = Product::whereAny(['name', 'slug', 'id'], 'like', "%$name%")->with('category', 'store')->paginate(10); 1 طريقة للبحث
        // --------------------------------
        if ($name !== null) {
            $query->whereAny(['name', 'slug', 'id'], 'like', "%$name%");
        }
        if ($status !== null) {
            $query->where('status', $status);
        }
        $products = $query->with('category', 'store')->paginate(10);
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $product = Product::all();
        $categories = Category::all();
        return view('dashboard.products.create', compact('product', 'categories'))
            ->with('success', 'producat success added');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string']
        ]);
        $request->merge([
            'slug' => Str::slug($request->name),
            'store_id' =>  Auth::user()->store_id,
            'user_id' => Auth::user()->id


        ]);
        $product = Product::create($request->all());
        return redirect(route('products.index'))->with('success', "New product added successfully ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::with('tags')->find($id);
        $tags = Tag::all();
        $categories = Category::all();
        $p_tags = $product->tags()->pluck('id')->toArray();
        return view('dashboard.products.edit', compact('product', 'categories', 'tags', 'p_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([]);
        // $tags = explode(',',$request->tags);
        // $tag_ids = [];
        // foreach($tags as $t_name){

        // }
        if ($request->has('p_image')) {
            $imagename = time() . '.' . $request->p_image->extension();
            $request->p_image->move(public_path('/products') , $imagename);
            $request->merge([
                'image' => $imagename
            ]);
        }
        $request->merge([
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->name),
            'store_id' =>  Auth::user()->store_id,

        ]);
        $product = Product::find($id);
        $product->update($request->except('tags'));
        // $product->tags()->attach($request->tags);
        // $tags = json_decode($request->tags);
        // $tag_ids = [];
        // $saved_tags = Tag::all();

        // foreach ($tags as $item) {
        //     $slug = str::slug($item->value);
        //     $tag = $saved_tags->where('slug', $slug)->first();
        //     if (!$tag) {
        //         $tag = Tag::create([
        //             'name' => $item->value,
        //             'slug' => $slug,
        //         ]);
        //     }
        //     $tag_ids[] = $tag->id;
        // }
        $product->tags()->sync($request->tags);

        return redirect(route('products.index'))->with('success', 'product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Product::find($id)->delete($id);

        return response()->json(['success' => true]);
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        return view('dashboard.products.trash.trash', ['products' => $products]);
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->restore();
        return redirect(route('product.trash'))->with('success', "The product was successfully Restore");
    }
    public function forcedelete($id)
    {
        $product = Product::find($id);
        $product->forceDelete();
        return redirect(route('product.trash'))->with('success', "The product was successfully force deleted");
    }
    public function restore_all()
    {
        $products = Product::onlyTrashed();
        $products->restore();
        return redirect(route('product.trash'))->with('success', "all products was successfully restore");
    }
}
