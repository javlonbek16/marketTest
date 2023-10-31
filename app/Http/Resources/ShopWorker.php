<?php

namespace App\Http\Resources;

use App\Models\Addresses;
use App\Models\Shop;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopWorker extends JsonResource
{

    public function toArray(Request $request): array
    {

        $work  = Work::find($this->work_id);
        $user = User::find($this->user_id);
        $shop = Shop::find($this->shop_id);
        $address = Addresses::find($this->address_id);
        
        return [
            'id' => $this->id,
            'work_id' => new WorkResource($work),
            'user_id' => new UserResource($user),
            'shop_id' => new ShopResource($shop),
            'address_id' => new AddressResource($address),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
