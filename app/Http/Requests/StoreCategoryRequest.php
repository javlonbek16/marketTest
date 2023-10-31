<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_name' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.required' => 'Categpry name kirtilmadi',
        ];
    }
}
