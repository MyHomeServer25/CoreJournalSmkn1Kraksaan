<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = auth()->user();
        if (!$user || $user->role !== $role) {
            // return response()->json([
            //     'message' => 'acces denied',
            // ], 403);
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => 'Access Denied. Please sign in to continue',
                ], 403);
            }
            
            // Untuk web request, gunakan abort untuk memicu exception handler
            abort(403, 'Access Denied. Please sign in to continue');
        }
        return $next($request);
    }
}
