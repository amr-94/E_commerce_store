@extends('layouts.dashboard')
@section('title', 'Trash of stores')
@section('breadcrumb', 'Trash of stores')
@section('content')
    <div class="mb-5">
        <a href="{{ route('stores.create') }}" class="btn btn-sm btn-outline-primary mr-2"> new</a>
        {{-- <a href="{{ route('stores.restore_all') }}" class="btn btn-sm btn-outline-danger mr-2"> restore_all </a> --}}
    </div>
    @component('components.alert')
    @endcomponent

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>img</th>
                <th>Name</th>
                <th>Status</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stores as $store)
                <tr>
                    <td>{{ $store->id }} </td>

                    {{-- @if ($store->store_cover !== null) --}}
                    <td> <img src="{{ asset("store/$store->store_cover") }}" class="img-circle elevation-2" width="50"
                            height="50" style="opacity: .8"> </td>
                    {{-- @endif --}}
                    <td>{{ $store->name }} </td>
                    <td>{{ $store->status }} </td>
                    <td>{{ $store->created_at->diffforhumans() }} </td>
                    <td>{{ $store->updated_at->diffforhumans() }} </td>
                    <td>
                        <form action="{{ route('stores.restore', $store->slug) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('stores.forcedelete', $store->slug) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Store Trash defined</td>
                </tr>
            @endforelse



        </tbody>
    </table>

    {{ $stores->links() }}



















@endsection
