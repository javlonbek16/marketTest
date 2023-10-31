<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use App\Models\WarehouseWorkers;

class WarehouseController extends Controller
{

    public function index()
    {
        $warehouses = Warehouse::all();

        return WarehouseResource::collection($warehouses);
    }

    public function store(StoreWarehouseRequest $request)
    {
        // if ($this->can('create_warehouse') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $warehouse = Warehouse::create($request->validated());

        return new WarehouseResource($warehouse);
    }

    public function show(Warehouse $warehouse)
    {
        if (!$warehouse)

            return response()->json(['message' => 'Warehouse not found'], 404);

        return new WarehouseResource($warehouse);
    }

    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        if ($this->can('update_warehouse') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $warehouse->update($request->validated());

        return new WarehouseResource($warehouse);
    }

    public function destroy(Warehouse $warehouse)
    {
        if ($this->can('delelte_warehouse') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $warehouse->delete();

        return new WarehouseResource($warehouse);
    }


    public function getWorkersInWarehouse(Warehouse $workers)
    {
        if ($this->canOffice('get_warehouse_workers') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $warehouseWorkers = $workers->workers()->get();

        return WarehouseWorkers::collection($warehouseWorkers);
    }

}
