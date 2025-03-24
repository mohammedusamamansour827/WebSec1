@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $quiz->title }}</h2>
    <p>{{ $quiz->question }}</p>

    @if(auth()->user()->role === 'student')
        <form action="{{ route('quizzes.answer', $quiz->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="answer">Your Answer:</label>
                <textarea name="answer" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Answer</button>
        </form>
    @endif
</div>
@endsection
