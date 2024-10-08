<?php

namespace App\Http\Requests\Admin;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserRequest extends \App\Foundation\FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request, UserService $service): array
    {
        $except = $request->user ? ", {$request->user->id}" : '';

        if ($service->hasRegisteredUsers()) {
            $rules['sponsor_username'] = ['required', 'string', 'exists:users,username'];
        }

        $rules['name'] = ['required', 'string', 'max:200'];
        $rules['username'] = ['required', 'string', 'max:40', 'unique:users,username' . $except];
        $rules['email'] = ['required', 'string', 'max:200', 'email'];
        $rules['phone_number'] = ['required', 'numeric', 'digits_between:10,14'];


        if (!$request->user) {
            $rules['password'] = ['required', 'string', 'min:8'];
            $rules['confirm_password'] = ['required', 'string', 'same:password'];
        }

        return $rules;
    }


    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'sponsor_username.exists' => 'The sponsor username is invalid.'
        ];
    }

}
