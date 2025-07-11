<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof MethodNotAllowedHttpException) {
                    return response()->json(['message' => 'The specified method is not allowed for this route.'], 405);
                }

                if ($e instanceof AuthenticationException) {
                    return response()->json(['message' => 'Unauthenticated.'], 401);
                }

                if ($e instanceof ValidationException) {
                    return response()->json([
                        'message' => 'The given data was invalid.',
                        'errors' => $e->errors(),
                    ], 422);
                }

                if ($e instanceof AccessDeniedHttpException || $e instanceof AuthorizationException || $e instanceof UnauthorizedException) {
                    return response()->json(['message' => 'You do not have the required permissions to perform this action.'], 403);
                }

                if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                    return response()->json(['message' => 'The requested resource was not found.'], 404);
                }

                // Generic server error
                return response()->json(['message' => 'A server error occurred. Please try again later.'], 500);
            }
        });
    })->create();

    // Add the TenancyServiceProvider here
    // This is a placeholder, as Laravel 11 has a different way of registering service providers
    // I will adjust this after looking at spatie/laravel-permission installation
