@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4">Product List</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Model</th>
                <th>Photo</th>
                <th>Description</th>
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
                        <img src="{{ asset('images/' . $product->photo) }}" alt="{{ $product->name }}" width="100">
                    </td>
                    <td>{{ $product->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
