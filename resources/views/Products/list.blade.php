@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4">Product List</h2>

    <!-- ✅ Show "Add Product" button only for admins -->
    @if(auth()->check() && auth()->user()->admin)
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>
    @endif

    <!-- ✅ Display message if no products exist -->
    @if ($products->isEmpty())
        <div class="alert alert-info">No products available.</div>
    @else
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Photo</th>
                    <th>Description</th>
                    @if(auth()->check() && auth()->user()->admin)
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->model }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" width="100">
                        </td>
                        <td>{{ $product->description }}</td>

                        <!-- ✅ Show Edit/Delete buttons only for admins -->
                        @if(auth()->check() && auth()->user()->admin)
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
