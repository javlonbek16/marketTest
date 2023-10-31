<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseWorkersRequest as StoreWorkerRequest;
use App\Http\Requests\UpdateWarehouseWorkersRequest as UpdateWorkerRequest;
use App\Models\WarehouseWorkers as Worker;
use App\Http\Resources\WarehouseWorker as WorkerResource;


class WarehouseWorkersController extends Controller
{
    public function index()
    {
        $workers = Worker::get();

        return WorkerResource::collection($workers);
    }

    public function store(StoreWorkerRequest $request)
    {

        $worker = Worker::create($request->validated());

        return new WorkerResource($worker);
    }

    public function show(Worker $worker)
    {
        if (!$worker)

            return response()->json(['message' => 'Worker not found'], 404);

        return new WorkerResource($worker);
    }

    public function update(UpdateWorkerRequest $request, Worker $worker)
    {

        if (!$worker)

            return response()->json(['message' => 'Worker not found'], 404);

        $worker->update($request->validated());

        return new WorkerResource($worker);
    }

    public function destroy(Worker $worker)
    {

        if (!$worker)

            return response()->json(['message' => 'Worker not found'], 404);

        $worker->delete();

        return new WorkerResource($worker);
    }

}
