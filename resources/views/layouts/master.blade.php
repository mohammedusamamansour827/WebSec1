<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'My Website')</title>

    <!-- ✅ Bootstrap & Custom Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- ✅ Font Awesome (For Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- ✅ Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
</head>

<body class="theme-light">
    <!-- ✅ Navbar/Menu -->
    @include('layouts.menu')

    <!-- ✅ Page Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- ✅ Dark Mode Toggle -->
    <button id="theme-toggle" class="btn btn-dark position-fixed bottom-3 end-3 p-2">
        <i class="fas fa-moon"></i>
    </button>

    <!-- ✅ Theme Toggle Script -->
    <script>
        const themeToggle = document.getElementById("theme-toggle");
        const body = document.body;

        themeToggle.addEventListener("click", function () {
            body.classList.toggle("theme-dark");
            body.classList.toggle("theme-light");

            // Change icon
            const icon = themeToggle.querySelector("i");
            icon.classList.toggle("fa-moon");
            icon.classList.toggle("fa-sun");
        });
    </script>

    <!-- ✅ Custom Styles -->
    <style>
        /* 🎨 Glassmorphism Theme */
        body.theme-light {
            background: #f8f9fa;
            color: #333;
        }
        body.theme-dark {
            background: #1a1a1a;
            color: #f8f9fa;
        }
        .container {
            transition: all 0.3s ease-in-out;
        }
        #theme-toggle {
            transition: all 0.3s ease-in-out;
        }
    </style>
</body>
</html>
