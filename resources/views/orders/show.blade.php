@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h2>Invoice</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                    <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
                    <p><strong>Customer Email:</strong> {{ $order->customer->email ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>Total Amount:</strong> <span class="h4">Tsh {{ $order->total_amount }}</span></p>
                </div>
            </div>

            <h4 class="mb-3">Order Items</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Tsh {{ $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to Orders</a>
        <a href="#" class="btn btn-secondary">Download PDF</a> <!-- Placeholder for PDF generation logic -->
    </div>
</div>
@endsection
