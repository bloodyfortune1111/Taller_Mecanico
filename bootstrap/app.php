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
        $middleware->web(\App\Http\Middleware\LogDeleteRequests::class);
        $middleware->alias([
            'admin.only' => \App\Http\Middleware\AdminOnly::class,
            'mecanico.only' => \App\Http\Middleware\MecanicoOnly::class,
            'recepcionista.only' => \App\Http\Middleware\RecepcionistaOnly::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
