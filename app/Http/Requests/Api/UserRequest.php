<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users',
            'user_password' => 'required',
            'user_role' => 'in:Normal,Manager,Admin',
        ];
    }
}
