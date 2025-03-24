@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Answer Quiz</h3>

    <form action="{{ route('quizzes.submitAnswer', $quiz->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ $quiz->question }}</label>
            <textarea name="answer" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit Answer</button>
    </form>
</div>
@endsection
