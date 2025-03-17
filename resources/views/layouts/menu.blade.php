<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/even') }}">Even Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/prime') }}">Prime Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/multable') }}">Multiplication Table</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/bill') }}">Supermarket Bill</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/calculator') }}">GPA Calculator</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/transcript') }}">Transcript</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.create') }}">Add User</a>
            </li>

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
                </li>
            @endguest

            <!-- ✅ Products Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                    Products
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('products.index') }}">View Products</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.create') }}">Add Product</a></li>
                </ul>
            </li>

            <!-- ✅ Exam Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="examDropdown" role="button" data-bs-toggle="dropdown">
                    Exam
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('questions.index') }}">Manage Questions</a></li>
                    <li><a class="dropdown-item" href="{{ url('/exam/start') }}">Start Exam</a></li>
                </ul>
            </li>

            <!-- ✅ To-Do List Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="todoDropdown" role="button" data-bs-toggle="dropdown">
                    To-Do List
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('tasks.index') }}">View Tasks</a></li>
                    <li><a class="dropdown-item" href="{{ route('tasks.create') }}">Add Task</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">Products</a>
            </li> -->

