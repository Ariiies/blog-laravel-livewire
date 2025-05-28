<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            // Protege todas las rutas de admin con 'auth'
            Route::middleware('web', 'auth')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
                // Protege las rutas de posts con 'auth'
            Route::middleware('web', 'auth')
                ->prefix('user')
                ->group(base_path('routes/posts.php'));
                
            

        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
