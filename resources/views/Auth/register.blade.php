@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    @if($errors->any())
        <p style="color: red;">{{ implode(', ', $errors->all()) }}</p>
    @endif

    <form method="POST" action="{{ route('register') }}" class="mt-3">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
