@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <!-- Button to add a new shop -->
                        <a href="{{ route('shops.create') }}" class="btn btn-primary">Add Shop</a>

                        <!-- Button to add a new attendant -->
                        <a href="{{ route('admin.attendants.create') }}" class="btn btn-secondary ml-2">Add Attendant</a>
                    </div>

                    <h3>Shops</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $shop)
                                <tr>
                                    <td>{{ $shop->id }}</td>
                                    <td>{{ $shop->name }}</td>
                                    <td>{{ $shop->description }}</td>
                                    <td>
                                        <a href="{{ route('shops.show', $shop->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
