<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;

class RoleRequest extends \App\Foundation\FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $except = $request->role ? ", {$request->role->id}" : '';

        return [
            'name' => ['required', 'string', 'max:250', "unique:roles,name" . $except],
            'priority' => ['required', 'integer', 'min:1', 'max:50000'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string']
        ];
    }
}
