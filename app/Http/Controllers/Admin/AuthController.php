<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Permission;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class AuthController extends \App\Foundation\Controller
{
    public function __construct(
        protected ResponseService $responseService
    ) {
    }

    public function login()
    {
        return view('admin.login');
    }

    public function handleLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        $remember = $request->has('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $admin = Auth::guard('admin')->user();
            if ($admin->cannot(Permission::ADMIN_PANEL)) {
                Auth::guard('admin')->logout();
                return $this->responseService->errors(errors: ['username' => ['Account is not authorized to visit the dashboard.']]);
            }

            $request->session()->regenerate();

            return $this->responseService->json(true, 'Login Successful!', [
                'redirect' => Redirect::intended(route('admin.home'))->getTargetUrl()
            ]);
        }

        $message = 'The provided credentials do not match our records.';
        return $this->responseService->errors(['username' => [$message], 'password' => [$message]]);
    }

    public function handleLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.auth.login');
    }
}
