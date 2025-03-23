@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <h2>Edit User</h2>

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

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        @if(auth()->user()->admin && auth()->id() !== $user->id)
            <!-- ✅ Only Admins Can Change Roles (Cannot Edit Their Own Role) -->
            <div class="mb-3">
                <label class="form-label">Role:</label>
                <select name="admin" class="form-select">
                    <option value="0" {{ !$user->admin ? 'selected' : '' }}>User</option>
                    <option value="1" {{ $user->admin ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
