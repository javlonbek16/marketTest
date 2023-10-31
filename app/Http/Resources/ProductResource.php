<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        $formattedPrice = $this->price . '$';
        $category = Category::find($this->category_id);
        $discount = Discount::find($this->discount_id);


        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $formattedPrice,
            'category' => $category ? new CategoryResource($category) : null,
            'discount' =>  $discount ? new DiscountResource($discount) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
