@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p><strong>Product ID:</strong> {{ $product->product_id }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>

    @if($product->image)
        <p><strong>Image:</strong> <img src="{{ asset('storage/' . $product->image) }}" width="200" height="180"></p>
    @else
        <p>No Image Available</p>
    @endif

    <a href="{{ route('products.edit', $product->id) }}">Edit</a> |
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
