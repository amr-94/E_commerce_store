@extends('layouts.dashboard')
@section('title', 'Stores')
@section('breadcrumb', 'Stores')
@section('content')
    <div class="mb-5">
        <a href="{{ route('stores.create') }}" class="btn btn-sm btn-outline-primary mr-2"> new</a>
        <a href="{{ route('stores.trash') }}" class="btn btn-sm btn-outline-dark"> Trash </a>
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
        <button type="submit" class="btn btn-primary" style="color: black">Search</button>
    </form>
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
            {{-- @php
                $stores = App\Models\Store::where('user_id', Auth::user()->id)->paginate(5);
            @endphp --}}
            @forelse ($stores as $store)
                <tr>
                    {{-- @if ($store->store_image !== null) --}}
                    <td> <img src="{{ asset("store/$store->cover_image") }}" class="img-circle elevation-2" width="50"
                            height="50" style="opacity: .8"> </td>
                    {{-- @endif --}}
                    <td>{{ $store->id }} </td>
                    <td><a href="{{ route('stores.show', $store->slug) }}">{{ $store->name }} </a></td>
                    <td>{{ $store->description }} </td>
                    <td><a href="{{ route('profile.show', $store->User->name) }}">{{ $store->User->name }} </a></td>
                    <td>{{ $store->status }} </td>
                    <td>{{ $store->created_at->diffforhumans() }} </td>
                    <td>{{ $store->updated_at->diffforhumans() }} </td>
                    <td><a href="{{ route('stores.edit', $store->slug) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('stores.destroy', $store->slug) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Stores defined</td>
                </tr>
            @endforelse



        </tbody>
    </table>

    {{ $stores->links() }}



















@endsection
