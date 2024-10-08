<?php

namespace App\Providers;

use App\Extensions\DatabaseSessionHandler;
use Illuminate\Support\ServiceProvider;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExceptionHandlerContract::class, Handler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Session::extend('custom-database', function ($app) {
            $table = $app['config']['session.table'];
            $lifetime = $app['config']['session.lifetime'];
            $connection = $app['db']->connection($app['config']['session.connection']);

            return new DatabaseSessionHandler($connection, $table, $lifetime, $app);
        });
    }
}
