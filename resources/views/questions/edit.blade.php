@extends('layouts.app')

@section('title', 'Edit Question')

@section('content')
<div class="container mt-4">
    <h2>Edit Question</h2>
    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Question</label>
            <input type="text" class="form-control" name="question" value="{{ $question->question }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option A</label>
            <input type="text" class="form-control" name="option_a" value="{{ $question->option_a }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option B</label>
            <input type="text" class="form-control" name="option_b" value="{{ $question->option_b }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option C</label>
            <input type="text" class="form-control" name="option_c" value="{{ $question->option_c }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option D</label>
            <input type="text" class="form-control" name="option_d" value="{{ $question->option_d }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correct Answer (A/B/C/D)</label>
            <input type="text" class="form-control" name="correct_option" value="{{ $question->correct_option }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Question</button>
        <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
