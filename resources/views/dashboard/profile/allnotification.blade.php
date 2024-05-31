@extends('layouts.dashboard')
@section('title', ' show profile')
@section('breadcrumb', 'show profile')
@section('content')

    {{-- <table class="table">
        <thead>
            <tr>
                <th>body</th>
                <th>order_id</th>
                <th>user</th>
                <th>order number</th>
                <th>adder name</th>
                <th>adder email</th>
                <th>adder phone</th>
                <th>Created_at</th>
                <th>updated_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse (Auth::user()->notifications as $notification)
                <tr>
                    <td>{{ $notification['data']['body'] }} </td>
                    <td>{{ $notification['data']['order_id'] }} </td>
                    <td>{{ $notification['user'] }} </td>
                    <td>
                        @foreach ($products as $product)
                            product name / {{ $product['name'] }}
                            product quantity / {{ $product['quantity'] }}
                            product price / {{ $product['price'] }}
                        @endforeach
                    </td>
                    <td>{{ $adder['first_name'] }} {{ $adder['last_name'] }} / {{ $adder['city'] }}</td>
                    <td>{{ $adder['email'] }}</td>
                    <td>{{ $adder['phone'] }}</td>
                    <td>{{ $notification->created_at->diffforhumans() }} </td>
                    <td>{{ $notification->updated_at->diffforhumans() }} </td>
                    @if ($category->user_id == Auth::id())
                        <td><a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Notifications defined</td>
                </tr>
            @endforelse
        </tbody>
    </table> --}}





    <div class="container">
        <h1>Notifications</h1>

        <div>
            @foreach (Auth::user()->notifications as $notification)
                <div class="card my-2">
                    <div class="card-body">

                        @if ($notification->unread())
                            <a href="{{ route('notify.read', $notification->id) }}" style="text-decoration: none;color: red">
                        @endif
                        <h4> Title : {{ $notification['data']['body'] }}</h4> </a>
                        {{-- {{ dd($adder) }} --}}
                        <p>From : {{ $adder['first_name'] }} {{ $adder['last_name'] }} / {{ $adder['street_adress'] }}</p>
                        <p>order_id : {{ $notification['data']['order_id'] }}</p>
                        <p>email : {{ $adder['email'] }}</p>
                        <p>phone : {{ $adder['phone'] }}</p>
                        {{-- {{ dd($products) }} --}}
                        <ul> product
                            @foreach ($products as $product)
                                <li>product name / {{ $product['name'] }}</li>
                                <li>product quantity / {{ 10000 - $product['quantity'] }}</li>
                                <li>product price / {{ $product['price'] }}</li>
                            @endforeach
                        </ul>
                        <p class="text-muted">{{ $notification->created_at->diffForhumans() }}</p>

                    </div>
                    {{-- <form action="{{ route('notification.destroy', $notifications->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Delete Notification</button>
                    </form> --}}


                </div>
            @endforeach
        </div>
        {{-- @if ($notifications->count() !== 0)
            <form action="{{ route('notification.destroyall') }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-primary" type="submit">Clear all Notifications</button>
            </form>
        @endif --}}


    </div>

@endsection
