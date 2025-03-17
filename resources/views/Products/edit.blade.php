@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update Product</button>
    </form>
</div>
@endsection
