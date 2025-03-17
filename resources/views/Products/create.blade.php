@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product</h2>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control">
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
</div>
@endsection
