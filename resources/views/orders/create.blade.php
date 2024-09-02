@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Order</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="product_ids">Products</label>
            <select name="product_ids[]" id="product_ids" class="form-control" multiple required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantities">Quantities</label>
            <input type="text" name="quantities[]" class="form-control" placeholder="Enter quantities separated by commas" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>
@endsection
