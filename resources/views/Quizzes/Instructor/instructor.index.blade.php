@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Available Quizzes</h2>

    @if($quizzes->isEmpty())
        <div class="alert alert-info">No quizzes available right now.</div>
    @else
        <ul class="list-group">
            @foreach($quizzes as $quiz)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $quiz->question }}
                    <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-sm btn-primary">Answer</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
