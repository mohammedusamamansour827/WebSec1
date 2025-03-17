@extends('layouts.app')

@section('title', 'Question Details')

@section('content')
<div class="container mt-4">
    <h2>Question Details</h2>
    <p><strong>Question:</strong> {{ $question->question }}</p>
    <p><strong>Options:</strong></p>
    <ul>
        <li>A) {{ $question->option_a }}</li>
        <li>B) {{ $question->option_b }}</li>
        <li>C) {{ $question->option_c }}</li>
        <li>D) {{ $question->option_d }}</li>
    </ul>
    <p><strong>Correct Answer:</strong> {{ strtoupper($question->correct_option) }}</p>
    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
