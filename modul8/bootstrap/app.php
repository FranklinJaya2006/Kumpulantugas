<?php

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
        $middleware->validateCsrfTokens(except: [
            'stripe/*',
            'http://localhost:8000/register',
            'http://localhost:8000/users',
            'http://localhost:8000/products',
            'http://localhost:8000/productsget',
            'http://localhost:8000/belis',
            'http://localhost:8000/belisget',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
