@extends('layouts.master')
@section('title', 'Prime Numbers')
@section('content')
    <div class="card m-4">
        <div class="card-header">Prime Numbers</div>
        <div class="card-body">
            @php
                function isPrime($num) {
                    if ($num < 2) return false;
                    for ($j = 2; $j <= sqrt($num); $j++) {
                        if ($num % $j == 0) return false;
                    }
                    return true;
                }
            @endphp

            @foreach (range(1, 100) as $i)
                @if(isPrime($i))
                    <span class="badge bg-primary">{{$i}}</span>
                @else
                    <span class="badge bg-secondary">{{$i}}</span>
                @endif
            @endforeach
        </div>
    </div>
@endsection
