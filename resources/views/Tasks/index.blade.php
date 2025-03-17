@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
    <ul class="list-group mt-3">
        @foreach ($tasks as $task)
            <li class="list-group-item">
                <strong>{{ $task->title }}</strong> - {{ $task->status }}
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
