<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
        $middleware->append(\App\Http\Middleware\Cors::class);

        // Middleware alias - format sebagai array
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'cors' => \Illuminate\Http\Middleware\HandleCors::class,
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
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            $status = $e->getStatusCode();
            $messages = [
                400 => 'Bad Request.',
                401 => 'Unauthorized.',
                403 => 'Forbidden.',
                404 => 'Record not found.',
                405 => 'Method Not Allowed.',
                500 => 'Internal Server Error.',
            ];
            
            $message = $messages[$status] ?? 'An error occurred.';
            
            // Only return JSON if it's explicitly an API route or JSON is expected
            if ($request->is('api/*') || ($request->expectsJson() && $request->ajax())) {
                return response()->json([
                    'message' => $message
                ], $status);
            }
            
            // For web routes, return view
            return response()->view("errors.$status", [
                'message' => $message
            ], $status);
        });   
        
    })->create();
