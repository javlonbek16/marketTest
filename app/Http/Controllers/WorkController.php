<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Http\Resources\WorkResource;
use App\Models\Work;

class WorkController extends Controller
{
    public function index()
    {

        $work = Work::get();

        return WorkResource::collection($work);
    }

    public function store(StoreWorkRequest $request)
    {
       

        $work = Work::create($request->validated());

        return new WorkResource($work);
    }

    public function show(Work $work)
    {

        if (!$work)

            return response()->json(['message' => 'Work not found'], 404);

        return new WorkResource($work);
    }

    public function update(UpdateWorkRequest $request, Work $work)
    {

        $work->update($request->validated());

        // Check

        return new WorkResource($work);
    }

    public function destroy(Work $work)
    {

        $work->delete();

        return new WorkResource($work);
    }
}
