@extends('layouts.dashboard')
@section('title', 'Create New category')
@section('breadcrumb', 'Create New category')
@section('content')

    <form action="{{ route('categories.store') }}" method="post" class="" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form')
    </form>




@endsection
