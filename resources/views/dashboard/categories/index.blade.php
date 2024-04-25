@extends('layouts.dashboards')


@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <div class="mb-5">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">CREATE</a>
    </div>
    @if (session()->has('sucsess'))
        <div class="alert alert-success">
            {{ session('sucsess') }}
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
            @if ($categories->count() > 0)
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent_id }}</td>
                        <td>{{ $category->image }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                class="btn-btn-sm btn-outline-success">EDIT</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post"
                                id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                    data-target="#confirmDeleteModal">DELETE</button>
                            </form>
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">: محمد عبدالله بيقولك </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this category?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" form="deleteForm" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <td colspan="7">No Categories Found</td>
            @endif

        </tbody>


    </table>
@endsection
