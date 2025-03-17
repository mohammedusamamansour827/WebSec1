@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4">
        <h2 class="mb-3">User Profile</h2>
        <div class="mb-3">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <h3 class="mt-4">Change Password</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update-password') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Old Password:</label>
                <input type="password" name="old_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm New Password:</label>
                <input type="password" name="new_password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
</div>
@endsection
