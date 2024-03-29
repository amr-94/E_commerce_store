@extends('layouts.dashboard')
@section('title', ' Trash categories')
@section('breadcrumb', 'categories')
@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-primary"> index</a>
    </div>

    @component('components.alert')
    @endcomponent
    <form action="{{ URL::current()}}" method="get" class="d-flex justify-content-between">
        <input type="text" name="name"  placeholder="Search..." class="row-cols-md-3 ">
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
                <th>status</th>
                <th>deleted_at</th>
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
                    <td>{{ $category->name }} </td>
                    <td>{{ $category->status }} </td>
                    <td>{{ $category->deleted_at->diffforhumans() }} </td>
                    <td><form action="{{ route('restore', $category->name) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-dark">Restore</button>
                    </form>
                    </td>
                    <td>
                        <form action="{{ route('forcedelete', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Categories defined</td>
                </tr>
            @endforelse



        </tbody>
    </table>

    {{ $categories->links() }}



















@endsection
