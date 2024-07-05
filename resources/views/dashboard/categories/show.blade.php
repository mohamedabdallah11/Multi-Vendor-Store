@extends('layouts.dashboards')


@section('title',$category->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>name</th>
            <th>store</th>
            <th>status</th>
            <th>Image</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>

        @if ($category->products->count() > 0)
        @php
            $products = $category->products()->with('store')->latest()->paginate(5);
        @endphp
            @foreach ($products as $product)  {{-- telegram --}}
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>

                    <td>
                        @if (!empty($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}" width="25" alt=""
                                height="25">
                        @endif
                    </td>


                    <td>{{ $product->created_at }}</td>

                   
                 
                </tr>
            @endforeach
        @else
            <td colspan="5">No products Found</td>
        @endif

    </tbody>


</table>
    {{ $products->withQueryString()->links() }}

@endsection
