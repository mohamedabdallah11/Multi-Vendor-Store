@extends('layouts.dashboards')


@section('title', 'EditCategories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">EditCategories</li>
@endsection

@section('content')
    <form action ="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.categories._form')

    </form>
    

@endsection
