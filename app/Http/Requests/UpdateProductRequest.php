<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'discount_id' => 'nullable',
            'warehouse_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Productga nom kirtilmadi',
            'description.required' => 'Productga tavsifi kirtilmadi',
            'image.required' => 'Productga rasm tanlanmadi',
            'image.image' => 'Productga rasm tanlanmadi',
            'image.mimes' => 'Productga rasm faqatgina PNG, or GIF formatda qabul qilinadi',
            'image.max' => 'Product rasmi 2 megabaytdan oshmasligi kerak',
            'price.required' => 'Producutga narx qo\'yilmadi',
            'price.numeric' => 'Producutga narxi raqam shaklida bo\'lishi kerak',
            'category_id.required' => 'Product categorysi tanlanmadi',
            'warehouse_id.required' => 'Product qatsidur omborga qo\;ylishi kerak',
        ];
    }
}
