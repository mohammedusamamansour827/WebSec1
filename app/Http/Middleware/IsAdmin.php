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
        // ✅ Check if the user is authenticated
        if (!Auth::check()) {
            return $this->denyAccess($request, 'You must be logged in.');
        }

        // ✅ Check if the authenticated user is an admin
        if (!Auth::user()->isAdmin()) {
            logger()->warning('Unauthorized access attempt by user: ' . Auth::user()->email);
            return $this->denyAccess($request, 'Access denied. Admins only.');
        }

        return $next($request);
    }

    /**
     * Handle unauthorized access response.
     */
    protected function denyAccess(Request $request, string $message): Response
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'status' => 403
            ], 403);
        }

        return redirect()->route('dashboard')->with('error', $message);
    }
}
