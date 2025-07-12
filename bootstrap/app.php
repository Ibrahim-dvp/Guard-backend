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
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                $statusCode = match (true) {
                    $e instanceof MethodNotAllowedHttpException => 405,
                    $e instanceof AuthenticationException => 401,
                    $e instanceof ValidationException => 422,
                    $e instanceof AuthorizationException || $e instanceof AccessDeniedHttpException || $e instanceof UnauthorizedException => 403,
                    $e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException => 404,
                    $e instanceof Illuminate\Database\QueryException => 500,
                    $e instanceof Symfony\Component\HttpKernel\Exception\HttpException => $e->getStatusCode(),
                    default => 500
                };

                // Custom messages for each exception type
                $customMessages = [
                    MethodNotAllowedHttpException::class => 'Method not allowed. Please check the HTTP method.',
                    AuthenticationException::class => 'Authentication required. Please login.',
                    ValidationException::class => 'Validation failed. Please check your input.',
                    AuthorizationException::class => 'You do not have permission to perform this action.',
                    AccessDeniedHttpException::class => 'Access denied. You do not have permission.',
                    UnauthorizedException::class => 'Unauthorized. Permission denied.',
                    ModelNotFoundException::class => 'Resource not found.',
                    NotFoundHttpException::class => 'Endpoint not found.',
                    Illuminate\Database\QueryException::class => 'A database error occurred. Please contact support.',
                    Symfony\Component\HttpKernel\Exception\HttpException::class => $e->getMessage() ?: 'HTTP error occurred.',
                ];

                $message = $customMessages[get_class($e)] ?? ($statusCode === 500 ? 'Server error. Please try again later.' : $e->getMessage());

                $response = [
                    'status' => false,
                    'message' => $message,
                    'code' => $statusCode,
                ];

                if ($e instanceof ValidationException) {
                    $response['errors'] = $e->errors();
                }
                if ($e instanceof Illuminate\Database\QueryException) {
                    $response['sql'] = $e->getSql();
                    $response['bindings'] = $e->getBindings();
                }

                // For debugging in non-production environments
                if (config('app.debug')) {
                    $response['debug'] = [
                        'exception' => get_class($e),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => collect($e->getTrace())->take(5)->all(),
                    ];
                }

                return response()->json($response, $statusCode);
            }
        });
    })->create();

    // Add the TenancyServiceProvider here
    // This is a placeholder, as Laravel 11 has a different way of registering service providers
    // I will adjust this after looking at spatie/laravel-permission installation
