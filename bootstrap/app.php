<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // then: function() {
        //     Route::middleware(['admin'])
        //         ->group(__DIR__.'/../routes/auth.php');
        // }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'seller' => \App\Http\Middleware\SellerMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
           
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
