@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>

    @if(auth()->user() && auth()->user()->admin)
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    @endif

    <ul class="list-group mt-3">
        @foreach($products as $product)
            <li class="list-group-item">
                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                @if(auth()->user() && auth()->user()->admin)
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
