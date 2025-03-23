<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">MyApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Side Menu -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/even') }}">Even Numbers</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/prime') }}">Prime Numbers</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/multable') }}">Multiplication Table</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/bill') }}">Supermarket Bill</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/calculator') }}">GPA Calculator</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/transcript') }}">Transcript</a></li>

                @auth
                    @can('manage-users')
                        <!-- Users Menu (Admins Only) -->
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}">Add User</a></li>
                    @endcan


                        <!-- Products Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                                Products
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('products.index') }}">View Products</a></li>
                                @can('create-products')
                                    <li><a class="dropdown-item" href="{{ route('products.create') }}">Add Product</a></li>
                                @endcan
                            </ul>
                        </li>


                    <!-- Exam Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="examDropdown" role="button" data-bs-toggle="dropdown">
                            Exam
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('questions.index') }}">Manage Questions</a></li>
                            <li><a class="dropdown-item" href="{{ url('/exam/start') }}">Start Exam</a></li>
                        </ul>
                    </li>

                    <!-- To-Do List Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="todoDropdown" role="button" data-bs-toggle="dropdown">
                            To-Do List
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('tasks.index') }}">View Tasks</a></li>
                            <li><a class="dropdown-item" href="{{ route('tasks.create') }}">Add Task</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>

            <!-- Right Side (Login/Logout) -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-secondary text-white ms-2" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
