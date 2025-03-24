@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
<div class="container">
    <h1 class="mb-4">My To-Do List</h1>

    @if($tasks->isEmpty())
        <div class="alert alert-info">You have no tasks.</div>
    @else
        <ul class="list-group">
            @foreach($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $task->title }}</strong><br>
                        <small>{{ $task->description }}</small>
                    </div>
                    <div>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-4">Add New Task</a>
</div>
@endsection
