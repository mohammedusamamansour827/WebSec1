@extends('layouts.master')

@section('title', 'Supermarket Bill')

@section('content')
<div class="container mt-4">
    <div class="card col-md-8 mx-auto">
        <div class="card-header bg-primary text-white text-center">
            <h3>{{ $bill->supermarket }} - Invoice</h3>
        </div>
        <div class="card-body">
            <p><strong>POS:</strong> {{ $bill->pos }}</p>
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($bill->products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->price }} EGP</td>
                        <td>{{ $product->quantity * $product->price }} EGP</td>
                    </tr>
                    @php $total += $product->quantity * $product->price; @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-success">
                        <th colspan="5" class="text-right">Total Amount:</th>
                        <th>{{ $total }} EGP</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
