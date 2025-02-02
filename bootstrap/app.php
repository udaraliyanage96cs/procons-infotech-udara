<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\AdminOnlyMiddleware;
use App\Http\Middleware\UserOnlyMiddleware;
use App\Console\Commands\CreateAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('auth_middleware',[AuthMiddleware::class]);
        $middleware->appendToGroup('admin_only_middleware',[AdminOnlyMiddleware::class]);
        $middleware->appendToGroup('user_only_middleware',[UserOnlyMiddleware::class]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands([
        CreateAdmin::class,
    ])->create();
