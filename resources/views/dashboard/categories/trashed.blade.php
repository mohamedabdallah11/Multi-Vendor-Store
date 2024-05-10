@extends('layouts.dashboards')


@section('title', 'Trashed')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content') 
<a href="{{ route('dashboard.categories.index') }}" class="btn btn-dark mx-2 ">Back</a>


    <x-alerts /> {{-- component --}}

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="name" class="mx-2" value="{{request('name')}}"/>
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>active</option>
            <option value="archived" @selected(request('status') == 'archived')>archived</option>
        </select>

        <button type="submit" class="btn btn-dark mx-2">Search</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>status</th>
                <th>Image</th>
                <th>deleted At</th>
                <th>
                    <form action="{{ route('categories.deleteAll') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn-btn-sm btn-outline-danger">DeleteAll</button>
                    </form>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->count() > 0)
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent_name }}</td>
                        <td>{{ $category->status }}</td>

                        <td>
                            @if (!empty($category->image))
                                <img src="{{ asset('storage/' . $category->image) }}" width="25" alt=""
                                    height="25">
                            @endif
                        </td>


                        <td>{{ $category->deleted_at }}</td>

                        <td>
                            <form action="{{route('dashboard.categories.restore', $category->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-success">Restore</button>
                            </form>
                        </td>
                        <td>
                       {{--      <form action="{{route('dashboard.categories.forceDelete', $category->id) }}" method="post"
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
                                            <h5 class="modal-title" id="confirmDeleteModalLabel"></h5>
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
                                            <button type="submit" form="deleteForm" class="btn btn-danger">forceDelete</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <form action="{{ route('dashboard.categories.forceDelete', $category->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">forceDelete</button>
                                </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <td colspan="7">No Categories Found</td>
            @endif

        </tbody>


    </table>
    {{ $categories->withQueryString()->links() }} {{-- pagination view and connected with boot strap at app service provider manually --}}
@endsection
