<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $limiter;

    // public function __construct(RateLimiter $limiter)
    // {
    //     $this->limiter = $limiter;
    // }

    // public function handle($request, Closure $next)
    // {
    //     $key = $request->ip();
        
    //     if ($this->limiter->tooManyAttempts($key, 60)) { // 60 requests max
    //         return response()->json([
    //             'message' => 'Too many requests'
    //         ], Response::HTTP_TOO_MANY_REQUESTS);
    //     }
        
    //     $this->limiter->hit($key, 60); // Reset after 60 seconds
        
    //     return $next($request);
    // }
}
