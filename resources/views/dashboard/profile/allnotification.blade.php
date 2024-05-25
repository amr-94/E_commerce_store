@extends('layouts.dashboard')
@section('title', ' show profile')
@section('breadcrumb', 'show profile')
@section('content')

    <table class="table">
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
                    {{-- @if ($category->user_id == Auth::id())
                        <td><a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Notifications defined</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
