<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Test</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.bundle.min.js"></script>

</head>

<?php
function isprime($number){
    if($number<2) return false;
    $x = $number - 1;
    while($x>1) {
        if($number%$x == 0) return false;
        $x--;
    }
    return true;
}
?>

<body>
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
        </ul>
    </div>
</nav>

    <div class="card m-4">
    <div class="card-body">
    Welcome to Home Page
    </div>
    </div>
</body>

</html>
