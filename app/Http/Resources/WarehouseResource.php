<?php

namespace App\Http\Resources;

use App\Models\Addresses;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $address = Addresses::find($this->address_id);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address_id' => new AddressResource($address),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
