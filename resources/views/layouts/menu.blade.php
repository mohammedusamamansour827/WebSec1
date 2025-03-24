<!-- Include Bootstrap Icons in your <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i> MyApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}"><i class="bi bi-house"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/even') }}"><i class="bi bi-list-ol"></i> Even Numbers</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/prime') }}"><i class="bi bi-award"></i> Prime Numbers</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/multable') }}"><i class="bi bi-x-diamond"></i> Multiplication Table</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/bill') }}"><i class="bi bi-receipt"></i> Supermarket Bill</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/calculator') }}"><i class="bi bi-calculator"></i> GPA Calculator</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/transcript') }}"><i class="bi bi-file-earmark-text"></i> Transcript</a></li>

                @auth
                    @can('manage-users')
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}"><i class="bi bi-people"></i> Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}"><i class="bi bi-person-plus"></i> Add User</a></li>
                    @endcan

                    <!-- Products -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box-seam"></i> Products
                        </a>
                        <ul class="dropdown-menu animate__animated animate__fadeIn">
                            <li><a class="dropdown-item" href="{{ route('products.index') }}">View Products</a></li>
                            @can('create-products')
                                <li><a class="dropdown-item" href="{{ route('products.create') }}">Add Product</a></li>
                            @endcan
                        </ul>
                    </li>




                    <!-- Exam -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="examDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-pencil-square"></i> Exam
                        </a>
                        <ul class="dropdown-menu animate__animated animate__fadeIn">
                            <li><a class="dropdown-item" href="{{ route('questions.index') }}">Manage Questions</a></li>
                            <li><a class="dropdown-item" href="{{ url('/exam/start') }}">Start Exam</a></li>
                        </ul>
                    </li>

                    <!-- To-Do List -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="todoDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-check2-square"></i> To-Do List
                        </a>
                        <ul class="dropdown-menu animate__animated animate__fadeIn">
                            <li><a class="dropdown-item" href="{{ route('tasks.index') }}">View Tasks</a></li>
                            <li><a class="dropdown-item" href="{{ route('tasks.create') }}">Add Task</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>




            <!-- Right Side -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-secondary text-white ms-2" href="{{ route('register') }}"><i class="bi bi-person-plus-fill"></i> Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu animate__animated animate__fadeIn">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>




