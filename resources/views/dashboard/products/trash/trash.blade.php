@extends('layouts.dashboard')
@section('title', 'products')
@section('breadcrumb', 'products')
@section('content')
    <div class="mb-5">
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-2"> new</a>
        <a href="{{ route('product.restore_all') }}" class="btn btn-sm btn-outline-danger mr-2"> restore_all </a>
    </div>
    @component('components.alert')
    @endcomponent
    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between">
        <input type="text" name="name" placeholder="Search..." class="row-cols-md-3 ">
        <select name="status" id="" class="form-control">
            <option value="">all</option>
            <option value="active">active</option>
            <option value="inactive">inactive</option>
            <option value="draft">draft</option>
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
                    @if ($product->category)
                        <td><a href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }}
                            </a>
                    @endif

                    </td>

                    <td>{{ $product->store->name }} </td>
                    <td>{{ $product->price }} </td>
                    <td>{{ $product->featured }} </td>
                    <td>{{ $product->status }} </td>
                    <td>{{ $product->created_at->diffforhumans() }} </td>
                    <td>{{ $product->updated_at->diffforhumans() }} </td>
                    <td> <form action="{{ route('product.restore', $product->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                    </form>
                    </td>
                    <td>
                        <form action="{{ route('product-forecdelete', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
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

    {{-- {{ $products->links() }} --}}



















@endsection
