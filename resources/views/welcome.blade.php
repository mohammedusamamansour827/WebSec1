<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ccc;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .main {
            flex-grow: 1;
            padding: 30px;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
   <!-- Sidebar -->
<div class="sidebar">
    <div class="text-center mb-4">
        <h4><i class="bi bi-speedometer2"></i> Dashboard</h4>
        @auth
            <p class="mb-1"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</p>
            @if(Auth::user()->role === 'customer')
                <p class="text-success fw-bold">Credit: ${{ number_format(Auth::user()->credit, 2) }}</p>
            @endif
        @endauth
    </div>

    <a href="{{ url('/') }}"><i class="bi bi-house"></i> Home</a>
    <a href="{{ url('/even') }}"><i class="bi bi-list-ol"></i> Even Numbers</a>
    <a href="{{ url('/prime') }}"><i class="bi bi-award"></i> Prime Numbers</a>
    <a href="{{ url('/multable') }}"><i class="bi bi-x-diamond"></i> Multiplication Table</a>
    <a href="{{ url('/bill') }}"><i class="bi bi-receipt"></i> Supermarket Bill</a>
    <a href="{{ url('/calculator') }}"><i class="bi bi-calculator"></i> GPA Calculator</a>
    <a href="{{ url('/transcript') }}"><i class="bi bi-file-earmark-text"></i> Transcript</a>

    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('users.index') }}"><i class="bi bi-people"></i> Users</a>
            <a href="{{ route('users.create') }}"><i class="bi bi-person-plus"></i> Add User</a>
        @endif

        @if(Auth::user()->role === 'employee')
            <a href="{{ route('products.index') }}"><i class="bi bi-box-seam"></i> Manage Products</a>
            <a href="{{ route('employee.customers') }}"><i class="bi bi-person-lines-fill"></i> My Customers</a>
        @endif

        @if(Auth::user()->role === 'customer')
            <a href="{{ route('purchases.index') }}"><i class="bi bi-bag-check"></i> My Purchases</a>
        @endif

        <a href="{{ route('profile.show') }}"><i class="bi bi-gear"></i> Profile</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @endauth
</div>


    <!-- Main Content -->
    <div class="main">
        <h2>Welcome to the Dashboard</h2>
        <p class="text-muted">Here are some quick stats and features:</p>

        <!-- Stat Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-person"></i> Total Users</h5>
                        <p class="card-text fs-3">4</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-calculator"></i> GPA Calculations</h5>
                        <p class="card-text fs-3">128</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-receipt"></i> Bills Created</h5>
                        <p class="card-text fs-3">1</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Message Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Welcome!</h4>
                <p class="card-text">Use the sidebar to navigate through different sections like GPA Calculator, Prime Numbers, and more.</p>
            </div>
        </div>
    </div>
</body>
</html>
