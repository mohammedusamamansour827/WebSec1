@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Profile</h2>

    <div class="card p-4">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <!-- ✅ Show Admin Badge if the user is an Admin -->
        @if($user->admin)
            <span class="badge bg-danger">Admin</span>
        @else
            <span class="badge bg-secondary">Regular User</span>
        @endif

        <hr>

        <!-- ✅ Only Admins or the User Themselves Can Edit Profile -->
        @if(auth()->user()->admin || auth()->user()->id == $user->id)
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit Profile</a>
        @endif

        <!-- ✅ Allow users to change their own password -->
        @if(auth()->user()->id == $user->id)
            <a href="{{ route('password.change') }}" class="btn btn-secondary">Change Password</a>
        @endif

        <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Users</a>
    </div>
</div>
@endsection
