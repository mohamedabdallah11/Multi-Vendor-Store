@extends('layouts.dashboards')


@section('title', 'Edit products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">products</li>
    <li class="breadcrumb-item active">Edit products</li>
@endsection

@section('content')
    <form action ="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.products._form')

    </form>
    

@endsection
