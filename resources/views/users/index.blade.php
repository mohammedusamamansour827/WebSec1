@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Users List</h2>

    <!-- ✅ Search Form -->
    <form method="GET" action="{{ route('users.index') }}" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search users..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th> <!-- ✅ New Column -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->admin)
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-secondary">User</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    @if(auth()->user()->admin) <!-- ✅ Only admins can delete -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                Delete
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
