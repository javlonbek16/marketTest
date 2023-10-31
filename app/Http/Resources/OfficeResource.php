<?php

namespace App\Http\Resources;

use App\Models\Addresses;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $address = Addresses::find($this->address_id);
        return [
            'id' => $this->id,
            'office_name' => $this->office_name,
            'address_id' => new AddressResource($address),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
