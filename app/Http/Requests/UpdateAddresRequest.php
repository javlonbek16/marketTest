<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country' => 'required|string',
            'province' => 'required|string',
            'phone' => 'required|string',
            'city_or_region' => 'required|string',
            'street' => 'required|string',
            'email' => 'required|email',
        ];
    }
    public function messages(): array
    {
        return [
            'country.required' => 'Davlat kirtilmadi',
            'province.required' => 'Viloyat kirtilmadi',
            'phone.required' => 'Telefon raqam kirtilmadi',
            'city_or_region.required' => 'Tuman yoki  Shahar kirtilmadi',
            'street.required' => 'Ko\'cha kirtilmadi',
            'email.required' => 'Email  kirtilmadi',
            'email.email' => 'Kirtilgan qiymat email emas',
            'phone.integer' => 'Kirtilgan qiymat raqamlardan tashkil topmagan',
        ];
    }
}
