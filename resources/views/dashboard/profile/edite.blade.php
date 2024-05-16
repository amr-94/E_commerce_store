@extends('layouts.dashboard')
@section('title', ' Edit profile')
@section('breadcrumb', 'Edit profile')
@section('content')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    @endif

    <form action="{{ route('profile.update') }}" method="post" class="" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="">first name</label>
            <input type="text" name="first_name" class="form-control"
                @if ($profile !== null) value="{{ $profile->first_name }}" @endif>
        </div>
        <div class="form-group">
            <label for="">last name</label>
            <input type="text" name="last_name" class="form-control"
                @if ($profile !== null) value="{{ $profile->last_name }}" @endif>
        </div>
        <div class="form-group">
            <label for="">Phone Number</label>
            <input type="number" name="phone_number" class="form-control"
                @if (Auth::user()->phone_number !== null) value="{{ Auth::user()->phone_number }}" @endif>
        </div>
        <div class="form-group">
            <label for="">birthday</label>
            <input type="date" name="birthday" class="form-control"
                @if ($profile !== null) value="{{ $profile->birthday }}" @endif>
        </div>
        <div class="form-group">
            <label for="">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" @if ($profile !== null && $profile->gender == 'male') checked @endif
                    value="male" name="gender">
                <label class="form-check-label" for="gender">
                    male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="female" name="gender"
                    @if ($profile !== null && $profile->gender == 'female') checked @endif>
                <label class="form-check-label" for="gender">
                    female
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="">address</label>
            <input type="text" name="address" class="form-control"
                @if ($profile !== null) value="{{ $profile->address }}" @endif>
            {{-- <input type="text" name="user_id" value="{{ Auth::user()->id }}" class="form-control" hidden> --}}
        </div>
        <div class="form-group">
            <label for="">City</label>
            <input type="text" name="city" class="form-control"
                @if ($profile !== null) value="{{ $profile->city }}" @endif>
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <select name="country" id="" type="text">
                <option value="">select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country }}"
                        @if ($profile !== null) @selected($profile->country == $country) @endif>{{ $country }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Local</label>
            <select name="local" id="">
                <option value="">select local</option>
                @foreach ($locales as $local)
                    <option
                        value="{{ $local }}"@if ($profile !== null) @selected($profile->local == $local) @endif>
                        {{ $local }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="">profile image</label>
            <input type="file" name="image" class="form-control" value="">
            @if (Auth::user()->profile_image)
                <img src="{{ asset('profile/' . $profile->profile_image) }}" hight="150" width="150" alt="30">
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">submit
        </div>
    </form>

    {{-- ------------------------------------- --}}
    @if (Auth::user()->products)

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
                @forelse (Auth::user()->products as $product)
                    <tr>
                        <td>{{ $product->id }} </td>

                        @if ($product->image !== null)
                            <td> <img src="{{ asset("product/$product->image") }}" class="img-circle elevation-2"
                                    width="50" height="50" style="opacity: .8"> </td>
                        @endif
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
    @endif


@endsection
