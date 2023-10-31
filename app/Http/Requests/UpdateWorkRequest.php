<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'work_name' => 'required|string',
            'salary' => 'required|integer',

        ];
    }
    public function messages(): array
    {
        return [

            'work_name.required' => 'Ish nomi maydoni to\'ldirilishi kerak.',
            'work_name.string' => 'Ish nomi maydoni matn bo\'lishi kerak.',
            'salary.integer' => 'Ish maoshi maydoni raqam bo\'lishi kerak.',
            'salary.required' => 'Ish maoshi maydoni to\'ldirilishi kerak.',

        ];
    }
}
