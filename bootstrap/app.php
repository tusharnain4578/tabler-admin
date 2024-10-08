<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__));

$app->withRouting(
    web: [
        __DIR__ . '/../routes/web.php',
    ],
    commands: __DIR__ . '/../routes/console.php',
    // health: '/up',
);

$app->withMiddleware(function (Middleware $middleware) {

    $middleware->append([
        \App\Http\Middleware\DisableBrowserCacheStore::class
    ]);

    $middleware->alias([
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class
    ]);

    $middleware->redirectGuestsTo(fn() => route('admin.auth.login'));
    $middleware->redirectUsersTo(fn() => route('admin.home'));




});


$app->withExceptions(function (Exceptions $exceptions) {
    // \Spatie\Permission\Exceptions\UnauthorizedException;


});

return $app->create();