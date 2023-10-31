<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopWorkersRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'work_id' => 'required|integer',
            'user_id' => 'required|integer',
            'address_id' => 'required|integer',
            'shop_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'work_id.required' => 'Ish ID maydoni to\'ldirilishi kerak.',
            'work_id.integer' => 'Ish ID butun son bo\'lishi kerak.',
            'user_id.required' => 'Foydalanuvchi ID maydoni to\'ldirilishi kerak.',
            'user_id.integer' => 'Foydalanuvchi ID butun son bo\'lishi kerak.',
            'address_id.required' => 'Manzil ID maydoni to\'ldirilishi kerak.',
            'address_id.integer' => 'Manzil ID butun son bo\'lishi kerak.',
            'shop_id.required' => 'Manzil ID maydoni to\'ldirilishi kerak.',
            'shop_id.integer' => 'Manzil ID butun son bo\'lishi kerak.',
        ];
    }
}
