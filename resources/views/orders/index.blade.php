@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Orders</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>Tsh {{ $order->total_amount }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('orders.show', $order->id) }}">View</a>
                            <a class="btn btn-warning" href="{{ route('orders.generateInvoice', $order->id) }}">Generate Invoice</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
