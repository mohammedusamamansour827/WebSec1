@extends('layouts.master')

@section('title', 'Exam Result')

@section('content')
<div class="card">
    <div class="card-header"><h4>Exam Result</h4></div>
    <div class="card-body">
        <h3>Your Score: {{ $score }}</h3>
        <a href="/exam/start" class="btn btn-primary">Retake Exam</a>
    </div>
</div>
@endsection
