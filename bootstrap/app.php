<?php

use App\Providers\MiddlewareServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withProviders([
        MiddlewareServiceProvider::class, // Register the Middleware Service Provider
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
