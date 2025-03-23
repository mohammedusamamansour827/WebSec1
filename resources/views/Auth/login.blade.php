@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4 rounded-4 border-0 glassmorphism" style="width: 100%; max-width: 400px;">

        <!-- 🏷️ Login Header -->
        <div class="text-center">
            <h3 class="fw-bold">Welcome Back!</h3>
            <p class="text-muted">Login to your account</p>
        </div>

        <!-- ✅ Authentication Error Message -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- ✅ Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- 🚀 Login Form -->
        <form method="POST" action="{{ route('login') }}" class="mt-3">
            @csrf

            <!-- 📧 Email Input (Floating Border) -->
            <div class="form-floating mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
                <label for="email">Email</label>
            </div>

            <!-- 🔒 Password Input (Floating Border) -->
            <div class="form-floating mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>
                <button type="button" class="btn btn-sm toggle-password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <!-- 📝 Remember Me -->
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>

            <!-- 🎯 Login Button -->
            <button type="submit" class="btn btn-primary w-100">Login</button>

            <!-- 🔗 Forgot Password -->
            <div class="text-center mt-2">
                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
            </div>

            <!-- 🔗 Register Link -->
            <div class="text-center mt-3">
                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-primary">Sign Up</a></p>
            </div>
        </form>
    </div>
</div>

<!-- 🔥 Floating Labels & Show Password Script -->
<script>
    document.querySelector('.toggle-password').addEventListener('click', function () {
        let passwordInput = document.getElementById('password');
        let icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
</script>

<!-- 🌟 Glassmorphism CSS -->
<style>
    .glassmorphism {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    .form-floating input:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
    }
    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
    }
</style>
@endsection
