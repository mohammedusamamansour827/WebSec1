@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Tasks</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">+ Add New Task</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($tasks->isEmpty())
        <p>No tasks yet.</p>
    @else
        <ul class="list-group">
            @foreach($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('tasks.show', $task) }}">
                            {{ $task->title }}
                        </a>
                        @if($task->is_completed)
                            <span class="badge bg-success">Done</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
