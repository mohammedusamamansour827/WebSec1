@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $product->name }}</h2>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
</div>
@endsection
