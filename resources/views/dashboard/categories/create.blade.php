@extends('layouts.dashboards')


@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <form action ="{{ route('dashboard.categories.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">CategoryName</label>
            <input type="text" name ="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">parentCategory</label>
            <select name ="parent_id" class="form-control form-select">
                <option value="">PrimaryCateogry </option>
                @foreach ($parentCategories as $parentCategory)
                    <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="">Description</label>
            <textarea type="text" name ="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name ="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="">status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="active" name="status" checked>
                <label class="form-check-label" >
                    active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="archived" name="status">
                <label class="form-check-label" >
                    archived
                </label>
            </div>

        </div>
        <div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>


@endsection
