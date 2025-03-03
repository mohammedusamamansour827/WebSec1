@extends('layouts.master')
@section('title', 'Multiplication Table')
@section('content')


@php($j=5)
<body>
<div class="card m-4 col-sm-2">
    <div class="card-header">{{$j}} Multiplication Table</div>
    <div class="card-body">
    <table>
    @foreach (range(1, 10) as $i)
    <tr><td>{{$i}} * {{$j}}</td><td> = {{ $i * $j }}</td></li>
    @endforeach
    </table>
    </div>
</div>
    </div>

</body>

</html>
@endsection
