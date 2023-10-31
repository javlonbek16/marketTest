<?php

namespace App\Http\Resources;

use App\Models\Addresses;
use App\Models\Office;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeWorker extends JsonResource
{

    public function toArray(Request $request): array
    {
        
        $work  = Work::find($this->work_id);
        $user = User::find($this->user_id);
        $office = Office::find($this->office_id);
        $address = Addresses::find($this->address_id);

        return [
            'id' => $this->id,
            'work_id' => new WorkResource($work),
            'user_id' => new UserResource($user),
            'office' => new OfficeResource($office),
            'address_id' => new AddressResource($address),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
