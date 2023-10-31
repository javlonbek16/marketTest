<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'perecent' => 'required|integer'
        ];
    }
    
    public function messages(): array
    {
        return [
            'perecent.required' => 'Foiz kirtilmadi',
            'perecent.integer' => 'Foiz  raqam shaklida kirtilmadi'
        ];
    }
}
