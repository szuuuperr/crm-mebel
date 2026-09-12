<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: middleware('role:admin,manajer')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles)) {
            // Redirect berdasarkan role user
            if ($user && $user->role === 'pelanggan') {
                return redirect()->route('pelanggan.dashboard');
            }

            if ($user && $user->role !== 'pelanggan') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('login');
        }

        return $next($request);
    }
}
