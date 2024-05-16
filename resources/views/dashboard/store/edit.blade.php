@extends('layouts.dashboard')
@section('title', 'Create New Store')
@section('breadcrumb', 'Create New category')
@section('content')
    {{-- Call Error component --}}
    <x-errors />
    {{-- -------------------------- Show Errors ---------- --}}
    <form action="{{ route('stores.update', $store->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ $store->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea type="text" name="description" class="form-control">{{ $store->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="">image</label>
            <input type="file" name="s_image" class="form-control">
            @if ($store->s_image)
                <img src="{{ asset('store/' . $store->s_image) }}" alt="">
            @endif
            @error('s_image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <select type="text" name="status" class="form-control form-select">
                <option value="active" @if ($store->status == 'active') selected @endif> active</option>
                <option value="inactive" @if ($store->status == 'inactive') selected @endif> inactive </option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="color: black">submit
        </div>
    </form>
@endsection
