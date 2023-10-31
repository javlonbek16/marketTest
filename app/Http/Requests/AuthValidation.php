<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthValidation extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username kirtilmadi',
            'username.unique' => 'Username allaqachon ro\'yhatdan otgan boshqa username yarating',
            'password.required' => 'Parol kirtilmadi',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo\'lishi kerak',
        ];
    }
}
