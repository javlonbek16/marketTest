<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return DiscountResource::collection($discounts);
    }

    public function store(StoreDiscountRequest $request)
    {

        if ($this->canWarehouse('create_discount') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);


        $discount = Discount::create($request->validated());

        return new DiscountResource($discount);
    }

    public function show(Discount $discount)
    {
        if (!$discount)

            return response()->json(['message' => 'Discount not found'], 404);

        return new DiscountResource($discount);
    }

    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        if ($this->canWarehouse('update_discount') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $discount->update($request->validated());

        return new DiscountResource($discount);
    }

    public function destroy(Discount $discount)
    {
        if ($this->canWarehouse('delete_discount') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $discount->delete();

        return new DiscountResource($discount);
    }
}
