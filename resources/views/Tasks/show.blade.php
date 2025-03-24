@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $task->title }}</h2>

    <p><strong>Description:</strong></p>
    <p>{{ $task->description }}</p>

    <p><strong>Status:</strong>
        @if($task->is_completed)
            <span class="badge bg-success">Completed</span>
        @else
            <span class="badge bg-warning">Pending</span>
        @endif
    </p>

    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
    