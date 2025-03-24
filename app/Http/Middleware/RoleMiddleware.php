<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Check if the authenticated user exists and has the correct role
        $user = Auth::user(); // Alternatively, use auth()->user()

        if (!$user || $user->role !== $role) {
            // If no user is authenticated or the role does not match, abort with a 403 error
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
