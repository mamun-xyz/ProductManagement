@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" placeholder="Search by Product ID or Description" value="{{ request()->search }}">
        <button type="submit">Search</button>
    </form>

    <p>Sort by:
        <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'name', 'sort_order' => request()->get('sort_order', 'asc') == 'asc' ? 'desc' : 'asc'])) }}">
            Name
        </a> |
        <a href="{{ route('products.index', array_merge(request()->all(), ['sort_by' => 'price', 'sort_order' => request()->get('sort_order', 'asc') == 'asc' ? 'desc' : 'asc'])) }}">
            Price
        </a>
    </p>

    <table border="1" style="border-collapse: collapse; width: 80%; text-align: center;">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="70" height="50">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}">View</a> |
                        <a href="{{ route('products.edit', $product->id) }}">Edit</a> |
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
        <div style="margin-top: 10px;">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
        <div>
            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
        </div>

@endsection
