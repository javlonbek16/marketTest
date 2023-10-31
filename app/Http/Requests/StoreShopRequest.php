<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shop_name' => 'required|string',
            'address_id' => 'required|integer',
            'warehouse_id' => 'required|integer',
        ];
    }
    
    public function messages(): array
    {
        return [
            'shop_name.required' => 'Do\'kon nomi maydoni to\'ldirilishi kerak.',
            'address_id.required' => 'Manzil  maydoni to\'ldirilishi kerak.',
            'warehouse_id.required' => 'Ombor  maydoni to\'ldirilishi kerak.',
        ];
    }

}
