@extends('layouts.app')

@section('title', 'Add Question')

@section('content')
<div class="container mt-4">
    <h2>Add New Question</h2>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Question</label>
            <input type="text" class="form-control" name="question" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option A</label>
            <input type="text" class="form-control" name="option_a" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option B</label>
            <input type="text" class="form-control" name="option_b" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option C</label>
            <input type="text" class="form-control" name="option_c" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option D</label>
            <input type="text" class="form-control" name="option_d" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correct Answer (A/B/C/D)</label>
            <input type="text" class="form-control" name="correct_option" required>
        </div>
        <button type="submit" class="btn btn-success">Save Question</button>
        <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
