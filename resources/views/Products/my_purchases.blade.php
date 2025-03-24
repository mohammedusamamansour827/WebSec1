@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Purchased Products</h2>

    @if($purchases->isEmpty())
        <div class="alert alert-info">You haven't purchased any products yet.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price ($)</th>
                    <th>Purchased On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->pivot->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
