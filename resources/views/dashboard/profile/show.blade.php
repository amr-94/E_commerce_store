@extends('layouts.dashboard')
@section('title', ' show profile')
@section('breadcrumb', 'show profile')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('profile/' . $user->profile->profile_image) }}">
            <p><b> User Name :</b>{{ $user->name }} {{ $user->profile->last_name }}</p>
            <p><b>Email :</b>{{ $user->email }}</p>
            <p><b>city :</b>{{ $user->profile->city }}</p>
            <p><b>phone :</b>{{ $user->phone }}</p>
            @auth
                @if ($user->id === Auth::user()->id)
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark">Edit</a>
                            </div>
                            <form method="post" action="{{ route('logout') }}" class="delete-form">
                                @csrf

                                <button type="submit" class="btn btn-sm btn-danger" style="color: black"> logout</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth

        </div>
        <div class="col-md-12" style="text-align: center">
            <h1>Stores of {{ $user->name }}</h1>
        </div>
        <div class="col-md-12" style="text-align: center">

            <table class="table">
                <thead>
                    <tr>
                        <th>img</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>user</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th>updated_at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($user->stores as $store)
                        <tr>
                            <td> <img src="{{ asset("store/$store->cover_image") }}" class="img-circle elevation-2"
                                    width="50" height="50" style="opacity: .8"> </td>
                            <td>{{ $store->id }} </td>
                            <td><a href="{{ route('stores.show', $store->slug) }}">{{ $store->name }} </a></td>
                            <td>{{ $store->description }} </td>
                            <td><a href="{{ route('profile.show', $store->User->name) }}">{{ $store->User->name }}
                                </a>
                            </td>
                            <td>{{ $store->status }} </td>
                            <td>{{ $store->created_at->diffforhumans() }} </td>
                            <td>{{ $store->updated_at->diffforhumans() }} </td>
                            @if ($store->user_id === Auth::user()->id)
                                <td><a href="{{ route('stores.edit', $store->slug) }}"
                                        class="btn btn-sm btn-outline-success">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('stores.destroy', $store->slug) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No Stores defined</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>



        <div class="col-md-12" style="text-align: center">
            <h1>Products of {{ $user->name }}</h1>
        </div>
        <div class="col-md-12" style="text-align: center">

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
                    @forelse ($user->products as $product)
                        <tr>
                            <td>{{ $product->id }} </td>
                            {{-- @if ($product->image !== null) --}}
                            <td> <img src="{{ asset("products/$product->image") }}" class="img-circle elevation-2"
                                    width="50" height="50" style="opacity: .8"> </td>
                            {{-- @endif --}}
                            <td>{{ $product->name }} </td>
                            @if ($product->category)
                                <td><a href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }}
                                    </a>
                            @endif
                            </td>
                            <td><a href="{{ route('stores.show', $product->store->slug) }}">{{ $product->store->name }}
                                </a></td>
                            <td>{{ $product->price }} </td>
                            <td>{{ $product->featured }} </td>
                            <td>{{ $product->status }} </td>
                            <td>{{ $product->user->name }} </td>
                            <td>{{ $product->created_at->diffforhumans() }} </td>
                            <td>{{ $product->updated_at->diffforhumans() }} </td>
                            @if ($product->user_id === Auth::user()->id)
                                <td><a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-sm btn-outline-success">Edit</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger deleteRecord"
                                        data-url="{{ route('products.destroy', $product->id) }}">Delete</a>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No products defined</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
