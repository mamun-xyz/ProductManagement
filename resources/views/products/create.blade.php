@extends('layouts.app')

@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="product_id">Product ID:*</label><br>
        <input type="text" name="product_id" required><br><br>

        <label for="name">Name:*</label><br>
        <input type="text" name="name" required><br><br>

        <label for="description">Description:</label><br>
        <textarea name="description"></textarea><br><br>

        <label for="price">Price:*</label><br>
        <input type="number" name="price" step="0.01" required><br><br>

        <label for="stock">Stock:</label><br>
        <input type="number" name="stock"><br><br>

        <label for="image">Product Image:</label><br>
        <input type="file" name="image"><br><br>

        <button type="submit">Create Product</button>
    </form>
@endsection
