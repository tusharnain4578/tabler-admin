<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }


    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (request()->expectsJson()) {
            return Response()->json(['error' => 'UnAuthorized'], 401); //exeption for api
        }
        $guard = data_get($exception->guards(), 0);
        $redirect = '';

        switch ($guard) {
            case 'admin':
                $redirect = route('admin.auth.login');
                break;
            default:
                $redirect = 'login';
                break;
        }
        return redirect()->guest($redirect);
    }
}