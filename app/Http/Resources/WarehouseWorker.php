<?php

namespace App\Http\Resources;

use App\Models\Addresses;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseWorker extends JsonResource
{

    public function toArray(Request $request): array
    {
        $work  = Work::find($this->work_id);
        $user = User::find($this->user_id);
        $warehouse = Warehouse::find($this->warehouse_id);
        $address = Addresses::find($this->address_id);

        return [
            'id' => $this->id,
            'work' => new WorkResource($work),
            'user' => new UserResource($user),
            'warehouse' => new WarehouseResource($warehouse),
            'address' => new AddressResource($address),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
