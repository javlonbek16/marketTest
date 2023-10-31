<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'address_id' => 'required|integer'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Nomi maydoni to\'ldirilishi kerak.',
            'description.required' => 'Tavsif maydoni to\'ldirilishi kerak.',
            'address_id.required' => 'Manzil ID maydoni to\'ldirilishi kerak.',
            'address_id.integer' => 'Manzil ID butun son bo\'lishi kerak.',
        ];
    }
}
