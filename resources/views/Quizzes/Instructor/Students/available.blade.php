@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Available Quizzes</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Question</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->question }}</td>
                    <td>
                        <a href="{{ route('quizzes.answer', $quiz->id) }}" class="btn btn-primary btn-sm">Answer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
