<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login'); // Make sure you have a 'resources/views/auth/login.blade.php' file
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); // Change 'dashboard' if needed
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
