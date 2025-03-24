@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Product List</h2>

    @can('manage-products')
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price ($)</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @can('manage-products')
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    @endcan

                    @auth
                        @if(auth()->user()->role === 'customer' && $product->stock > 0)
                            <form action="{{ route('products.buy', $product) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-primary btn-sm" onclick="return confirm('Confirm purchase?')">Buy</button>
                            </form>
                        @endif
                    @endauth
                </td>
            </tr>
            @empty
                <tr><td colspan="4">No products found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
