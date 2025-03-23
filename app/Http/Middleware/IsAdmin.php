<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Check if the user is authenticated and an admin
        if (Auth::check() && Auth::user()->admin) {
            return $next($request);
        }

        // ✅ Log unauthorized access attempts (optional)
        logger()->warning('Unauthorized access attempt by user: ' . (Auth::user()->email ?? 'Guest'));

        // ✅ Handle API requests separately
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Access denied. Admins only.',
                'status' => 403
            ], 403);
        }

        // ✅ Redirect with an error message for web requests
        return redirect()->route('dashboard')->with('error', 'Access denied. Admins only.');
    }
}
