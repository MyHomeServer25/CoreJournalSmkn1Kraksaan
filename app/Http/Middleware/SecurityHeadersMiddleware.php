<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle($request, Closure $next)
    // {
    //     $response = $next($request);
        
    //     $response->headers->set('X-XSS-Protection', '1; mode=block');
    //     $response->headers->set('X-Frame-Options', 'DENY');
    //     $response->headers->set('X-Content-Type-Options', 'nosniff');
    //     $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
    //     $response->headers->set('Content-Security-Policy', "default-src 'self'");
    //     $response->headers->set('Permissions-Policy', 'geolocation=()');
        
    //     return $response;
    // }
}
