@extends('layouts.dashboards')


@section('title', 'EditCategories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">EditCategories</li>
@endsection

@section('content')
    <form action ="{{ route('dashboard.categories.update', $category->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">CategoryName</label>
            <input type="text" name ="name" class="form-control" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="">parentCategory</label>
            <select name ="parent_id" class="form-control form-select">
                <option value="">PrimaryCateogry </option>
                @foreach ($parentCategories as $parentCategory)
                    <option value="{{ $parentCategory->id }}"@selected($parentCategory->id==$category->parent_id)>{{ $parentCategory->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="">Description</label>
            <textarea type="text" name ="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name ="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">status</label>  
            <div class="form-check">
                <input class="form-check-input" type="radio"  name="status" value="active" @checked($category->status=='active')
                    
                >
                <label class="form-check-label" >
                    active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio"  name="status" value="archived" @checked($category->status=='archived')
                    
                >
                <label class="form-check-label" >
                    archived
                </label>
            </div>

        </div>
        <div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    

@endsection
