@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New User</h2>

    <!-- ✅ Show validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" minlength="6" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password confirmation</label>
            <input type="password confirmation" name=" password_confirmation" class="form-control" minlength="6" required>
        </div>

        @if(auth()->user()->admin)
            <!-- ✅ Only Admins Can Assign Admin Roles -->
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="admin" class="form-select">
                    <option value="0" selected>Regular User</option>
                    <option value="1">Admin</option>
                </select>
            </div>
        @endif

        <button type="submit" class="btn btn-success">Create User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
