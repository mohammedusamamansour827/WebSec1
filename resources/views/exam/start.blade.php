@extends('layouts.master')

@section('title', 'Start Exam')

@section('content')
<div class="card">
    <div class="card-header"><h4>Start Exam</h4></div>
    <div class="card-body">
        <form action="/exam/submit" method="POST">
            @csrf
            @foreach($questions as $question)
            <div class="mb-3">
                <h5>{{ $question->question }}</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question_{{ $question->id }}" value="A">
                    <label class="form-check-label">{{ $question->option_a }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question_{{ $question->id }}" value="B">
                    <label class="form-check-label">{{ $question->option_b }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question_{{ $question->id }}" value="C">
                    <label class="form-check-label">{{ $question->option_c }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question_{{ $question->id }}" value="D">
                    <label class="form-check-label">{{ $question->option_d }}</label>
                </div>
            </div>
            @endforeach
            <button type="submit" class="btn btn-success">Submit Exam</button>
        </form>
    </div>
</div>
@endsection
