@extends('layouts.dashboard')
@section('title', "$category->name")

@section('breadcrumb', "Categories / $category->name ")

@section('content')

    <div class="mb-5">
        <p class=""> number of products {{ $category->products->count() }}</p>

        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-2"> new</a>
        <a href="{{ route('trash') }}" class="btn btn-sm btn-outline-dark"> Trash </a>
    </div>

    @component('components.alert')
    @endcomponent
    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between">
        <input type="text" name="name" placeholder="Search..." class="row-cols-md-3 ">
        <select name="status" id="" class="form-control">
            <option value="">all</option>
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
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

                    @if ($product->image !== null)
                        <td> <img src="{{ asset("product/$product->image") }}" class="img-circle elevation-2" width="50"
                                height="50" style="opacity: .8"> </td>
                    @endif
                    <td>{{ $product->name }} </td>
                    {{-- @if ($category->parent_id !== null) --}}
                    <td><a href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }} </a>
                    </td>
                    {{-- @endif --}}

                    <td>{{ $product->store->name }} </td>
                    <td>{{ $product->price }} </td>
                    <td>{{ $product->featured }} </td>
                    <td>{{ $product->status }} </td>
                    <td>{{ $product->created_at->diffforhumans() }} </td>
                    <td>{{ $product->updated_at->diffforhumans() }} </td>
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
                </tr>
            @empty
                <tr>
                    <td colspan="7">No products defined</td>
                </tr>
            @endforelse



        </tbody>
    </table>

    {{ $products->links() }}



















@endsection
