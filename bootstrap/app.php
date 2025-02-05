<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->group('api', [
        //     \App\Http\Middleware\RateLimitMiddleware::class,
        //     \App\Http\Middleware\SecurityHeadersMiddleware::class,
        // ]);
        // Middleware grup
        //  $middleware->group('api', [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        //     'throttle:api',
        //     \Illuminate\Routing\Middleware\SubstituteBindings::class,
        // ]);

        // Middleware alias - format sebagai array
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->render(function ($request, Throwable $exception) {
        //     if($exception instanceof ThrottleRequestsException) {
        //         return response()->json([
        //             'message' => 'Jangan keras-keras bang, slow aja.'
        //         ], Response::HTTP_TOO_MANY_REQUESTS);
        //     }
        // });
    })->create();
