@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-primary">Admin Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Users</h5>
                    <h2>{{ $userCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Tasks</h5>
                    <h2>{{ $taskCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Latest Registered Users</h4>
    <div class="card border-0 shadow">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse($latestUsers as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $user->name }}
                        <span class="text-muted">{{ $user->email }}</span>
                    </li>
                @empty
                    <li class="list-group-item">No users yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
