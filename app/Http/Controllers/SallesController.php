<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSallesRequest;
use App\Models\Client;
use App\Models\Product;
use App\Models\Salles;
use App\Models\Shop;

class SallesController extends Controller
{
    public function store(StoreSallesRequest $request)
    {

        $data = $request->validated();

        $shop = Shop::findOrFail($data['shop_id']);
        $product = Product::findOrFail($data['product_id']);
        $client = Client::findOrFail($data['client_id']);

        if ($product->sale_or_not == true) {
            return response()->json(['message' => 'Product already Selled'], 400);
        }

        if ($product->is_in_warehouse == true) {
            return response()->json(['message' => 'Product is  in the Warehouse'], 400);
        }

        if ($client->wallet->balance < $product->price) {
            return response()->json(['message' => 'You do not have enough money. Please fill your wallet.'], 400);
        }

        $salles = new Salles();
        $salles->fill($data);

        $salles->shop()->associate($shop);
        $salles->product()->associate($product);
        $salles->client()->associate($client);

        $salles->save();

        $product->sale_or_not = true;
        $product->is_in_shop = false;
        $product->save();

        $client->wallet->balance -= $product->price;
        $client->wallet->save();

        return response()->json(['message' => 'Sale created successfully', 'salles' => $salles], 201);
    }
}
