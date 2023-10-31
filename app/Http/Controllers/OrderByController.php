<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfficeResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Http\Resources\WarehouseResource;
use App\Models\Client;
use App\Models\Office;
use App\Models\Product;
use App\Models\Salles;
use App\Models\Shop;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class OrderByController extends Controller
{

    public function orderByProductCreate_at(Request $request)
    {
        $products = Product::orderBy('created_at', 'asc')->get();
        return ProductResource::collection($products);
    }

    public function OrderByClientCreate_at(Request $request)
    {
        $client = Client::orderBy('created_at', 'asc')->get();
        return ($client);
    }

    public function OrderBySallesCreate_at()
    {
        $salles = Salles::orderBy('created_at', 'asc')->get();
        return ($salles);
    }

    public function OrderByShopsCreate_at()
    {
        $shop = Shop::orderBy('created_at', 'asc')->get();
        return ShopResource::collection($shop);
    }

    public function OrderByWarehousesCreate_at()
    {
        $warehouse = Warehouse::orderBy('created_at', 'asc')->get();
        return WarehouseResource::collection($warehouse);
    }

    public function OrderByOfficesCreate_at()
    {
        $offices = Office::orderBy('created_at', 'asc')->get();
        return OfficeResource::collection($offices);
    }
}
