<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CountSiteVisit;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
           $middleware->alias([
            'CheckRole' => App\Http\Middleware\CheckRole::class,
            'CountSiteVisit' => \App\Http\Middleware\CountSiteVisit::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
