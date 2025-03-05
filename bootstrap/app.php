<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Mockery\Exception\BadMethodCallException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if (request()->is('api/*')) {
            $exceptions->render(function (Throwable $e) {
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'data' => [],
                        'message' => __('api.not_found'),
                        'errors' => [],
                        'status' => 404
                    ], 404);
                }

                if ($e instanceof BindingResolutionException) {
                    return response()->json([
                        'data' => [],
                        'message' => config('app.debug') ? $e->getMessage() : __('api.server_error'),
                        'errors' => [],
                        'status' => 500
                    ], 500);
                }

                if ($e instanceof ModelNotFoundException) {
                    return response()->json([
                        'data' => [],
                        'message' => __('api.not_found'),
                        'errors' => [],
                        'status' => 404
                    ], 404);
                }

                if ($e instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                        'data' => [],
                        'message' => __('api.not_allowed_method'),
                        'errors' => [],
                        'status' => 405
                    ], 405);
                }

                if ($e instanceof RouteNotFoundException) {
                    return response()->json([
                        'data' => [],
                        'message' => __('api.not_found_route'),
                        'errors' => [],
                        'status' => 500
                    ], 500);
                }

                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'data' => [],
                        'message' => __('api.unauthenticated'),
                        'errors' => [],
                        'status' => 401
                    ], 401);
                }

                if ($e instanceof AccessDeniedHttpException) {
                    return response()->json([
                        'data' => [],
                        'message' => __('api.this_action_is_unauthorized'),
                        'errors' => [],
                        'status' => 403
                    ], 403);
                }

                if ($e instanceof BadMethodCallException) {
                    return response()->json([
                        'data' => [],
                        'message' => __('api.not_allowed_method'),
                        'errors' => [],
                        'status' => 403
                    ], 403);
                }

                return response()->json([
                    'data' => [],
                    'message' => config('app.debug') ? $e->getMessage() : __('api.server_error'),
                    'errors' => [],
                    'status' => 500
                ], 500);

            });
        }
    })->create();
