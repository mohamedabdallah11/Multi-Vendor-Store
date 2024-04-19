@extends('layouts.dashboards')


@section('title', 'Categories')
@section('breadcrumb') 
    @parent
    <li class="breadcrumb-item active" >Categories</li>
    @endsection

@section('content')

<div class="mb-5" >
    <a href="{{route('categories.create')}}" class="btn btn-sm btn-outline-primary">CREATE</a>
</div>
@if(session()->has('sucsess'))
<div class="alert alert-success">
    {{session('sucsess')}}
</div>
@endif
<table class="table">
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Image</th>
        <th>Created At</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @if($categories->count() > 0)
            @foreach($categories as $category)
        
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->parent}}</td>
        <td>{{$category->image}}</td>
        <td>{{$category->created_at}}</td>
        <td>
            <a href="{{route('categories.edit', $category->id)}}" class="btn-btn-sm btn-outline-success">EDIT</a>
        </td>
        <td>
            <form action="{{route('categories.destroy', $category->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-btn-sm btn-outline-danger">DELETE</button>
            </form>
        </td>
    </tr>
           @endforeach
    @else
    <td colspan="7">No Categories Found</td>
    @endif

</tbody>


</table>
@endsection