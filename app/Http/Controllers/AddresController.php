<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddresRequest;
use App\Http\Requests\UpdateAddresRequest;
use App\Http\Resources\AddressResource;
use App\Models\Addresses;

class AddresController extends Controller
{

    public function index()
    {
        $addresses = Addresses::all();

        return AddressResource::collection($addresses);
    }

    public function store(StoreAddresRequest $request)
    {
        // if ($this->canOffice('create_address') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $address = Addresses::create($request->validated());

        return new AddressResource($address);
    }

    public function show(Addresses $address)
    {
        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return new AddressResource($address);
    }

    public function update(UpdateAddresRequest $request, Addresses $address)
    {
        // if ($this->canOffice('update_address') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $address->update($request->validated());

        return new AddressResource($address);
    }

    public function destroy(Addresses $address)
    {
        
        // if ($this->canOffice('delete_address') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $address->delete();

        return new AddressResource($address);
    }
}
