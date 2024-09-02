@extends('layouts.app')

@section('content')

<h1>Attendant Dashboard</h1>
<p>Welcome to the shop: {{ $shop->name }}</p> <!-- Ensure $shop is an object with 'name' attribute -->

<!-- Add Product Button (Visible to attendants) -->
@auth
    @if (Auth::user()->role === 'attendant')
        <!-- Link to Add New Shop -->
        <a class="btn btn-primary" href="{{ route('attendant.shops.create') }}">Add New Shop</a>
        
        <!-- Link to Add New Product -->
        <a class="btn btn-success mt-2" href="{{ route('attendant.products.create') }}">Add New Product</a>
        
        <!-- Link to Add New Category -->
        <a class="btn btn-info mt-2" href="{{ route('categories.create') }}">Add New Category</a>
    @endif
@endauth

@endsection
