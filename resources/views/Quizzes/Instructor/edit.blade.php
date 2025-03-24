@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Quiz</h2>

    <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $quiz->title }}" required>
        </div>

        <div class="mb-3">
            <label for="question">Question:</label>
            <textarea name="question" class="form-control" required>{{ $quiz->question }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Quiz</button>
    </form>
</div>
@endsection
