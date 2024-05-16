@extends('layouts.dashboard')
@section('title', "$store->name")

@section('breadcrumb', "Store / $store->name ")

@section('content')

    <div class="mb-5">
        <p class=""> number of products in this store {{ $store->products->count() }}</p>

        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-2"> new</a>
        <a href="{{ route('trash') }}" class="btn btn-sm btn-outline-dark"> Trash </a>
    </div>

    @component('components.alert')
    @endcomponent

    <h3 style="text-align: center">All Products From : {{ $store->name }} Store</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>img</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Price</th>
                <th>Featured</th>
                <th>Status</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }} </td>
                    <td> <img src="{{ asset("product/$product->image") }}" class="img-circle elevation-2" width="50"
                            height="50" style="opacity: .8"> </td>
                    <td>{{ $product->name }} </td>
                    <td><a href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }}
                        </a>
                    </td>
                    <td>{{ $product->store->name }} </td>
                    <td>{{ $product->price }} </td>
                    <td>{{ $product->featured }} </td>
                    <td>{{ $product->status }} </td>
                    <td>{{ $product->created_at->diffforhumans() }} </td>
                    <td>{{ $product->updated_at->diffforhumans() }} </td>
                    @if ($product->user_id === Auth::user()->id || Auth::user()->type == 'admin')
                        <td><a href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7">No products defined in this store</td>
                </tr>
            @endforelse



        </tbody>
    </table>

    {{-- {{ $products->links() }} --}}



















@endsection
