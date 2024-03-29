@extends('layouts.dashboard')
@section('title', ' Edit category')
@section('breadcrumb', 'Edit category')
@section('content')

    <form action="{{ route('categories.update', $category->id) }}" method="post" class="" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('dashboard.categories._form')

    </form>




@endsection
