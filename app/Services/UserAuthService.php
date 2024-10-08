<?php

namespace App\Services;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\User;

class UserAuthService
{
    public function register(RegisterRequest $request)
    {
        $sponsor = User::getByUsername($request->validated('sponsor_username'));

        $user = new User($request->validated());
        $user->sponsor_id = $sponsor?->id;

        return true;
    }
}