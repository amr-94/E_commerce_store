@extends('layouts.dashboard')
@section('title', 'products')
@section('breadcrumb', 'products')
@section('content')
    <div class="mb-5">
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary mr-2"> new</a>
        <a href="{{ route('product.trash') }}" class="btn btn-sm btn-outline-dark"> Trash </a>
        <p> {{ $products->count() }}</p>
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
        <button type="submit" class="btn btn-primary" style="color: black">Search</button>
    </form>
    <h3 class="text-center">Product Of User : {{ Auth::user()->name }}</h3>
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
                <th>user</th>
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
                        <td> <img src="{{ asset("products/$product->image") }}" class="img-circle elevation-2"
                                width="50" height="50" style="opacity: .8"> </td>
                    @else
                        <td> <img src="{{ asset('categories/1704130929.jpg') }}" class="img-circle elevation-2"
                                width="50" height="50" style="opacity: .8"> </td>
                    @endif
                    <td>{{ $product->name }} </td>
                    @if ($product->category)
                        <td><a href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }}
                            </a>
                    @endif

                    </td>

                    <td><a href="{{ route('stores.show', $product->store->slug) }}">{{ $product->store->name }} </a></td>
                    <td>{{ $product->price }} </td>
                    <td>{{ $product->featured }} </td>
                    <td>{{ $product->status }} </td>
                    <td>{{ $product->user->name }} </td>
                    <td>{{ $product->created_at->diffforhumans() }} </td>
                    <td>{{ $product->updated_at->diffforhumans() }} </td>
                    <td><a href="{{ route('products.edit', $product->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger deleteRecord"
                            data-url="{{ route('products.destroy', $product->id) }}">Delete</a>
                        {{-- <a href="javascript:void(0)" data-url="{{ route('products.destroy', $product->id) }}"
                            class="btn btn-danger delete-user">Delete</a> --}}

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No products defined</td>
                </tr>
            @endforelse



        </tbody>
    </table>



    <script type="text/javascript">
        // $(document).ready(function() {

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     /*------------------------------------------
        //     --------------------------------------------
        //     When click user on Delete Button
        //     --------------------------------------------
        //     --------------------------------------------*/
        //     $(document).on('click', '.delete-user', function() {

        //         var userURL = $(this).data('url');
        //         var trObj = $(this);

        //         if (confirm("Are you sure you want to delete this user?") == true) {
        //             $.ajax({
        //                 url: userURL,
        //                 type: 'DELETE',
        //                 dataType: 'json',
        //                 success: function(data) {
        //                     alert(data.success);
        //                     trObj.parents("tr").remove();
        //                 }
        //             });
        //         }

        //     });

        // });
        // ---------------------------------------------------------------------------- anthor way
        // $(".deleteRecord").click(function() {
        //     var id = $(this).data("id");
        //     var token = $("meta[name='csrf-token']").attr("content");
        //     var trObj = $(this);
        //     $.ajax({
        //         url: "products/" + id,
        //         type: 'DELETE',
        //         data: {
        //             "id": id,
        //             "_token": token,
        //         },
        //         success: function(data) {
        //             alert(data.success);
        //             trObj.parents("tr").remove();
        //         }
        //     });

        // });
        // ---------------------------------------------------------- anthor way
        $(".deleteRecord").click(function() {

            var token = $("meta[name='csrf-token']").attr("content");
            var trObj = $(this);
            var userURL = $(this).data('url');

            $.ajax({
                url: userURL,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function(data) {
                    alert(data.success);
                    trObj.parents("tr").remove();
                }
            });

        });
    </script>

    {{ $products->links() }}



















@endsection
