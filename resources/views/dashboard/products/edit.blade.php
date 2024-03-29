@extends('layouts.dashboard')
@section('title', 'update product')
@section('breadcrumb', 'update product')
@section('content')
    @component('components.alert')
        @component('components.errors')

            <form action="{{ route('products.update', $product->id) }}" method="post" class="" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for=""> description </label>
                    <textarea class="form-control" aria-label="With textarea" name="description">{{ $product->description }}"</textarea>
                </div>
                <div class="form-group">
                    <label for=""> price </label>
                    <input type="number" name="price" class="form-control" step="0.01" min="0.00" placeholder="0.00"
                        value="{{ $product->price }}">
                    <label for=""> compare price </label>
                    <input type="number" name="compare_price" class="form-control" step="0.01" min="0.00"
                        value="{{ $product->compare_price }}" placeholder="0.00">
                </div>

                <div class="form-group">
                    <label for=""> options </label>
                    <input type="text" name="options" class="form-control" value="{{ $product->options }}">
                </div>
                <div class="form-group">
                    <label for=""> rating </label>
                    <input type="number" name="rating" class="form-control" value="{{ $product->rating }}">
                </div>

                <div class="form-group">
                    <label for="">category</label>
                    <select type="text" name="category_id" class="form-control form-select">
                        <option value="">primary category</option>
                        @foreach ($categories as $categories)
                            <option value="{{ $categories->id }}" @if ($categories->id == $product->category_id) selected @endif>
                                {{ $categories->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for=""> Tags </label>
                    <input name='tags' autofocus class="form-control">
                </div> --}}
                <label for=""> Select Tags
                    @foreach ($tags as $tags)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $tags->id }}" name="tags[]"
                            @if (in_array($tags->id, $p_tags))checked @endif
                                id="{{ $tags->id }}">
                            <label class="form-check-label">{{ $tags->name }} </label>
                        </div>

                    @endforeach
                    <div class="form-group"> Tags :
                        <ul>
                            @foreach ($product->tags as $tags)
                                <li> <a> {{ $tags->name }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </label>
                <div class="form-group">
                    <label for="">Status</label>
                    <select type="text" name="status" class="form-control form-select">
                        <option value="active" @if ($product->status == 'active') selected @endif> active</option>
                        <option value="inactive" @if ($product->status == 'inactive') selected @endif> inactive </option>
                        <option value="draft" @if ($product->status == 'draft') selected @endif> draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">image</label>
                    <input type="file" name="p_image" class="form-control" value="">
                    @if ($product->image)
                        <img src="{{ asset("products/$product->image") }}" alt="" width="25%" hight="25%">
                    @endif
                    @error('img')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">submit
                </div>



            </form>

            <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
            <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
            <script>
                var inputElm = document.querySelector('[name=tags]');
                tagify = new Tagify(inputElm);
            </script>

        @endsection
