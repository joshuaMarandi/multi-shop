@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Inventory</h2>
        @if($lowInventory->isNotEmpty())
            <div class="alert alert-warning">
                <strong>Warning!</strong> Some products are low in stock.
                <ul>
                    @foreach($lowInventory as $product)
                        <li>{{ $product->name }} (Quantity: {{ $product->stock_quantity }})</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category ID</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->description }}</td>
                        <td>Tsh {{ $product->price }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
