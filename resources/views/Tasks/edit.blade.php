@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Task</h2>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Task Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $task->description }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_completed" class="form-check-input" {{ $task->is_completed ? 'checked' : '' }}>
            <label class="form-check-label">Completed</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection
