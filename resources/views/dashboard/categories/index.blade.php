@extends('layouts.dashboard')
@section('title', 'categories')
@section('breadcrumb', 'categories')
@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary mr-2"> new</a>
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
                <th>img</th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Active products #</th>
                <th>inActive products #</th>
                <th>status</th>
                <th>Created_at</th>
                <th>updated_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    @if ($category->image !== null)
                        <td> <img src="{{ asset("categories/$category->image") }}" class="img-circle elevation-2"
                                width="50" height="50" style="opacity: .8"> </td>
                    @endif
                    <td>{{ $category->id }} </td>
                    <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }} </a></td>
                    {{-- @if ($category->parent_id !== null) --}}
                    <td>{{ $category->parent->name }} </td>
                    {{-- @endif --}}
                    <td>{{ count($category->products->where('status', 'active')) }} </td>
                    <td>{{ count($category->products->where('status', 'inactive')) }} </td>

                    <td>{{ $category->status }} </td>
                    <td>{{ $category->created_at->diffforhumans() }} </td>
                    <td>{{ $category->updated_at->diffforhumans() }} </td>
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
            @endif

        @empty
            <tr>
                <td colspan="7">No Categories defined</td>
            </tr>
            @endforelse



        </tbody>
    </table>

    {{ $categories->links() }}



















@endsection
