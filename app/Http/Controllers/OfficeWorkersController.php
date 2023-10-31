<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeWorkersRequest as UpdateWorkerRequest;
use App\Http\Requests\UpdateOfficeWorkersRequest as StoreWorkerRequest;
use App\Models\OfficeWorkers as Worker;
use App\Http\Resources\OfficeWorker as WorkerResource;


class OfficeWorkersController extends Controller
{
    public function index()
    {
        $workers = Worker::all();

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
