@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>

    <!-- ✅ Display authentication errors -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- ✅ Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
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

        <!-- ✅ Optional: Admin Checkbox (Only if needed) -->
        @if(auth()->check() && auth()->user()->admin)
            <div class="mb-3 form-check">
                <input type="checkbox" name="admin" id="admin" class="form-check-input" value="1">
                <label for="admin" class="form-check-label">Make this user an admin</label>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
