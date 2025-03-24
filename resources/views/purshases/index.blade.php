@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Purchases</h2>
    <ul class="list-group">
        @forelse($products as $product)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $product->name }}</span>
                <span>${{ number_format($product->price, 2) }}</span>
            </li>
        @empty
            <li class="list-group-item text-muted">You haven't purchased anything yet.</li>
        @endforelse
    </ul>
</div>
@endsection
