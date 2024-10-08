<?php

namespace App\Foundation;

use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;


abstract class FormRequest extends HttpFormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
