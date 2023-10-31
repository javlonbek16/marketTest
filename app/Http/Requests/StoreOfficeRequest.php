<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfficeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'office_name' => 'required|string',
            'address_id' => 'required|integer'
        ];
    }

    public function  message(): array
    {
        return [
            'office_name' => 'Offisning ismi kirtilmadi',
            'address_id' => 'Address id kirtilmadi',
        ];
    }
}
