<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\OfficeResource;
use App\Http\Resources\OfficeWorker;
use App\Models\Office;


class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::get();

        return OfficeResource::collection($offices);
    }

    public function store(StoreOfficeRequest $request)
    {
        // if ($this->canOffice('create_office') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $office = Office::create($request->validated());

        return new OfficeResource($office);
    }

    public function show(Office $office)
    {
        return new OfficeResource($office);
    }

    public function update(UpdateOfficeRequest $request, Office $office)
    {
        if ($this->canOffice('update_office') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $office->update($request->validated());

        return new OfficeResource($office);
    }

    public function destroy(Office $office)
    {
        if ($this->canOffice('delete_office') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $office->delete();

        return new OfficeResource($office);
    }

    public function getOfficeAddress(Office $address)
    {
        $address = $address->address();

        return AddressResource::collection($address);
    }

    public function getWorkersInOffice(Office $workers)
    {
        if ($this->canOffice('get_office_workers') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $officeWorkers = $workers->workers()->get();

        return OfficeWorker::collection($officeWorkers);
    }
}
