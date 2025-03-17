@extends('layouts.app')  <!-- Change this to match your layout file -->

@section('title', 'Manage Questions')

@section('content')
<div class="container">
    <h2 class="my-4">Manage Questions</h2>
    <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">Add New Question</a>

    @if ($questions->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Options</th>
                    <th>Correct Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question }}</td>
                    <td>
                        A) {{ $question->option_a }} <br>
                        B) {{ $question->option_b }} <br>
                        C) {{ $question->option_c }} <br>
                        D) {{ $question->option_d }}
                    </td>
                    <td>{{ strtoupper($question->correct_option) }}</td>
                    <td>
                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No questions found.</p>
    @endif
</div>
@endsection
