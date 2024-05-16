<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $request = request();
        $query = Category::query();
        $name = $request->name;
        $status = $request->status;
        if ($name !== null) {
            $query->whereAny(['name', 'slug', 'id'], 'like', "%$name%");
        }
        if ($status !== null) {
            $query->where('status', $status);
        }
        // $categories = $query->withTrashed()->paginate(10);
        $categories = $query->paginate(10);

        // ------------
        // $categories =  Category::active()->paginate(1);
        // $categories =  Category::inactive()->paginate(1);
        // -------------------------------------------
        return view('dashboard.categories.index', [
            'categories' => $categories,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(Category::rules());
        if ($request->has('img')) {
            $filename = time() . '.' . $request->img->extension();
            $request->img->move(public_path('categories/'), $filename);
            $request->merge(
                [
                    'image' => $filename,

                ]
            );
            $request->merge(
                [

                    'slug' => Str::slug($request->name)

                ]
            );
        }
        // --------------------------------------
        // if ($request->has('img')) {
        //     $file = $request->file('img');
        //     $file->store('categories',[
        //         'disk'=> 'public'
        //     ]);
        //     $request->merge(
        //         [
        //             'image' => $file,
        //             'slug' => Str::slug($request->name)

        //         ]
        //     );
        // }
        $category = Category::create($request->all());
        return redirect(route('categories.index'))->with('success', 'category has added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        $category = Category::findOrFail($id);
        $products = $category->products()->with('store')->paginate(5);
        return view('dashboard.categories.show', compact('products', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $categories = Category::all()->except($id);
        // dd($categories);
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category->image !== null && $request->img !== null) {
            File::delete(public_path('categories/' . $category->image));
        }
        if ($request->has('img')) {
            $filename = time() . '.' . $request->img->extension();
            //---------------------------------
            // $filename = $request->img->getClientOriginalName() . '.' . $request->img->extension();
            //---------------------------------------
            $request->img->move(public_path('/categories'), $filename);
            $request->merge([
                'image' => $filename,
                'slug' => str::slug($request->name)
            ]);
        }
        $category->update($request->all());
        return redirect(route('categories.index'))->with('success', "category $category->name updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findorfail($id);
        if ($category->image !== null) {
            file::delete(public_path('categories/' . $category->image));
        }
        $category->delete($id);
        // -------------------
        // Category::destroy($id);
        return redirect(route('categories.index'))->with('success', "category $category->name deleted");
    }



    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(3);
        return view('dashboard.categories.deleted', compact("categories"));
    }
    public function restore($name)
    {
        $category = Category::onlyTrashed()->where('name', $name);
        $category->restore();
        return redirect(route('trash'));
    }
    public function forcedelete(Request $request, $id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();
        return redirect(route('trash'));
    }
}