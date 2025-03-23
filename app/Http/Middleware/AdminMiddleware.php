<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Ensure user is authenticated and an admin
        if (!auth()->check() || !auth()->user()->admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized access! Admins only.'], 403);
            }
            return redirect('/')->with('error', 'Unauthorized access! Admins only.');
        }

        return $next($request);
    }
}
