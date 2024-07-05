@extends('layouts.dashboards')


@section('title', 'products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection

@section('content')

    <div class="mb-5">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-dark mx-2 ">CREATE</a>
      {{--  <a href="{{ route('dashboard.products.trash') }}" class="btn btn-dark ">Trashed</a> --}}
    </div>


    <x-alerts /> {{-- component --}}

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="name" class="mx-2" value="{{ request('name') }}" />
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
                <th>category</th>
                <th>store</th>
                <th>status</th>
                <th>Image</th>
                <th>Created At</th>
                {{--   <th>
                    <form action="{{ route('products.deleteAll') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn-btn-sm btn-outline-danger">DeleteAll</button>
                    </form>
                </th> --}}
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->status }}</td>

                        <td>
                            @if (!empty($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" width="25" alt=""
                                    height="25">
                            @endif
                        </td>


                        <td>{{ $product->created_at }}</td>

                        <td>
                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                class="btn-btn-sm btn-outline-success">EDIT</a>
                        </td>
                        <td>
                            {{--               <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post"
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
                                            Are you sure you want to delete this product?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" form="deleteForm" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      --}}
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            @else
                <td colspan="9">No products Found</td>
            @endif

        </tbody>


    </table>
    {{ $products->withQueryString()->links() }} {{-- pagination view and connected with boot strap at app service provider manually --}}
@endsection
