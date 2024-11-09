@extends('layouts.app')

@section('content')
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="product_id">Product ID:*</label><br>
        <input type="text" name="product_id" value="{{ $product->product_id }}" required><br><br>

        <label for="name">Name:*</label><br>
        <input type="text" name="name" value="{{ $product->name }}" required><br><br>

        <label for="description">Description:</label><br>
        <textarea name="description">{{ $product->description }}</textarea><br><br>

        <label for="price">Price:*</label><br>
        <input type="number" name="price" value="{{ $product->price }}" step="0.01" required><br><br>

        <label for="stock">Stock:</label><br>
        <input type="number" name="stock" value="{{ $product->stock }}"><br><br>

        <label for="image">Product Image:</label><br>
        <input type="file" name="image"><br><br>

        @if($product->image)
            <p>Current Image: <img src="{{ asset('storage/' . $product->image) }}" width="50" height="50"></p>
        @endif

        <button type="submit">Update Product</button>
    </form>
@endsection
