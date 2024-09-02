@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Product</h2>
        <form method="POST" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="category_id">Category ID:</label>
                <input type="number" id="category_id" name="category_id" class="form-control" value="{{ $product->category_id }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="stock_quantity">Quantity:</label>
                <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
@endsection
