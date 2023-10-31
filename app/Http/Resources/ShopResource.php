<?php

namespace App\Http\Resources;

use App\Models\Addresses;
use App\Models\Warehouse;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    public function toArray($request)
    {
        $address = Addresses::find($this->address_id);
        $warehouse = Warehouse::find($this->warehouse_id);
        
        return [
            'id' => $this->id,
            'shop_name' => $this->shop_name,
            'address' => new AddressResource($address),
            'warehouse' => new WarehouseResource($warehouse),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
