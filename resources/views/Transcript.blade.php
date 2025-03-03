@extends('layouts.master')

@section('title', 'Student Transcript')

@section('content')



<div class="container mt-5">
    <h2>Student Transcript</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">{{ $student->name }}</h4>
            <p><strong>Student ID:</strong> {{ $student->id }}</p>
            <p><strong>Major:</strong> {{ $student->major }}</p>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Course Code</th>
                <th>Title</th>
                <th>Credit Hours</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->courses as $course)
            <tr>
                <td>{{ $course->code }}</td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->credits }}</td>
                <td>{{ $course->grade }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
