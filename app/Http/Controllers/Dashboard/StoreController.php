<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = request()->name;
        $status = request()->status;
        $query = Store::query();
        if ($name !== null) {
            $query->whereAny(['name', 'slug', 'id'], 'like', "%$name%");
        }
        if ($status !== null) {
            $query->where('status', $status);
        }
        if (Auth::user()->type == 'admin') {
            $stores = $query->paginate(5);
        } else {
            $stores = $query->where('user_id', Auth::user()->id)->paginate(5);
        }
        return view('dashboard.store.index', [
            'stores' => $stores
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.store.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);
        if ($request->hasFile('s_image')) {
            $filename = time() . '.' . $request->s_image->extension();
            $request->s_image->move(public_path('store'), $filename);
            $request->merge([
                'cover_image' => $filename
            ]);
        }
        Store::create($request->all());
        return redirect(route('stores.index'))->with('success', 'store created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $store = Store::where('slug', $id)->with('products')->first();
        $products = $store->products;
        $user = User::where('id', $store->user_id)->first();
        $currentUser = Auth::user();
        if ($currentUser->type == 'user' && $user->type == 'admin') {
            return redirect(route('dashboard'))->with('success', 'Access denied to admin profile!');
        } else {
            return view('dashboard.store.show', [
                'store' => $store,
                'products' => $products

            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $store = Store::where('slug', $id)->first();
        return view('dashboard.store.edit', [
            'store' => $store
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $store = Store::where('slug', $id)->first();

        $request->validate([
            'name' => ['required'],
        ]);
        if ($request->hasFile('s_image')) {
            $filename = time() . '.' . $request->s_image->extension();
            $request->s_image->move(public_path('store'), $filename);
            $request->merge([
                'cover_image' => $filename
            ]);
        }
        if ($request->s_image !== null && $request->s_image !== $store->cover_image) {
            File::delete(public_path('store/' . $store->cover_image));
        }
        $store->update($request->all());

        return redirect(route('stores.index'))->with('success', 'store updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Store::where('slug', $id)->delete();
        return redirect(route('stores.index'))->with('success', 'store deleted');
    }
    public function trash()
    {
        $stores = Store::onlyTrashed()->paginate(5);
        return view('dashboard.store.trash', [
            'stores' => $stores
        ]);
    }
    public function restore(string $id)
    {
        Store::withTrashed()->where('slug', $id)->restore();
        return redirect(route('stores.index'))->with('success', 'store restored');
    }
    public function forcedelete(string $id)
    {
        $store = Store::withTrashed()->where('slug', $id)->forceDelete();
        if ($store->cover_image !== null) {
            File::delete(public_path('store/' . $store->cover_image));
        }
        return redirect(route('stores.index'))->with('success', 'store deleted');
    }
}
