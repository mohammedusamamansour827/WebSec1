<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function login()
    {
        return view('auth.login'); // Ensure this view exists in 'resources/views/auth/login.blade.php'
    }

    /**
     * Handle login request.
     */
    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember'); // Remember user if checkbox is checked

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // ✅ Redirect based on role
            return $user->admin
                ? redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!')
                : redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        // ❌ Check if the user exists before returning an error
        return User::where('email', $request->email)->exists()
            ? back()->withErrors(['password' => 'Incorrect password.'])->withInput()
            : back()->withErrors(['email' => 'No account found with this email.'])->withInput();
    }

    /**
     * Handle logout request.
     */
    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    /**
     * Apply authentication middleware.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'doLogin']);
    }
}
