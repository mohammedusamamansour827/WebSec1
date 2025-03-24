@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create Quiz</h3>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <textarea name="question" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
