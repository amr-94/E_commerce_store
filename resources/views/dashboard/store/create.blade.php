@extends('layouts.dashboard')
@section('title', 'Create New Store')
@section('breadcrumb', 'Create New category')
@section('content')
    {{-- Call Error component --}}
    <x-errors />
    {{-- -------------------------- Show Errors ---------- --}}

    <form action="{{ route('stores.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Store Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea type="text" name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="">image</label>
            <input type="file" name="s_image" class="form-control" value="">
            @error('s_image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Status</label>

            <div class="form-check">
                <input class="form-check-input" type="radio" value="active" name="status">
                <label class="form-check-label" for="status">
                    active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="inactive" name="status">
                <label class="form-check-label" for="status">
                    inactive
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="color:black">submit
        </div>
    </form>
@endsection
