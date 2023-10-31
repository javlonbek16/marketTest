<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{

    public function toArray($request)
    {
        $formattedPrecet = $this->perecent . '%';
        return [
            'id' => $this->id,
            'percent' => $formattedPrecet,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
