@extends('layouts.dashboard')
@section('title', 'Create New product')
@section('breadcrumb', 'Create New product')
@section('content')
    @component('components.alert')
        @component('components.errors')

            <form action="{{ route('products.store') }}" method="post" class="" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">product Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""> description </label>
                    <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for=""> price </label>
                    <input type="number" name="price" class="form-control" step="0.01" min="0.00" placeholder="0.00">
                    <label for=""> compare price </label>
                    <input type="number" name="compare_price" class="form-control" step="0.01" min="0.00"
                        placeholder="0.00">
                </div>

                <div class="form-group">
                    <label for=""> options </label>
                    <input type="text" name="options" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""> rating </label>
                    <input type="number" name="rating" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">category</label>
                    <select type="text" name="category_id" class="form-control form-select">
                        <option value="">primary category</option>
                        @foreach ($categories as $categories)
                            <option value="{{ $categories->id }}">
                                {{ $categories->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select type="text" name="status" class="form-control form-select">
                        <option value="active"> active</option>
                        <option value="inactive"> inactive </option>
                        <option value="draft"> draft</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">submit
                </div>



            </form>




        @endsection
