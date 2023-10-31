<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Http\Resources\ShopWorker;
use App\Http\Resources\WarehouseResource;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {

        $shops = Shop::all();

        return ShopResource::collection($shops);
    }

    public function store(StoreShopRequest $request)
    {
        // if ($this->canShop('create_shop') != 'can')

        //     return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $shop = Shop::create($request->validated());

        return new ShopResource($shop);
    }

    public function show(Shop $shop)
    {
        return new ShopResource($shop);
    }

    public function update(UpdateShopRequest $request, Shop $shop)
    {
        if ($this->canShop('update_shop') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $shop->update($request->validated());

        return new ShopResource($shop);
    }

    public function destroy(Shop $shop)
    {
        if ($this->canShop('delete_shop') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $shop->delete();

        return new ShopResource($shop);
    }

    public function moveProducts(Request $request)
    {

        if ($this->canShop('move_product') != 'can') {
            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);
        }
        $product_id = $request->product_id;
        $warehouse_id = $request->warehouse_id;
        $shop_id = $request->shop_id;

        $shop = Shop::find($shop_id);
        $warehouse = Warehouse::find($warehouse_id);
        $product = Product::find($product_id);

        if (!$shop || !$warehouse || !$product) {
            return response()->json(['message' => 'Shop, warehouse, or product not found'], 404);
        }

        // Check if the product is already in the shop or sold

        if ($product->is_in_shop || $product->sale_or_not) {
            return response()->json([
                'message' => 'The product is already in the shop or sold',
                'product' => $product,
            ]);
        }

        // Move the product from the warehouse to the shop

        DB::beginTransaction();
        try {
            $product->is_in_warehouse = false;
            $product->is_in_shop = true;
            $product->shop_id = $shop->id;
            $product->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed to move the product',
                'error' => $e->getMessage(),
            ], 500);
        }

        // Load the updated relationships

        $shop->load('products');
        $warehouse->load('products');

        return response()->json([
            'message' => 'Product moved successfully',
            'product' => $product,
            'shop' => new ShopResource($shop),
            'warehouse' => $warehouse,
        ]);
    }

    public function getProductsInShop(Request $request)
    {
        if ($this->canShop('move_product_in_shop') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $shop_id = $request->shop_id;
        $shop = Shop::find($shop_id);

        $products = $shop->products()->get();

        return ProductResource::collection($products);
    }

    public function getWorkersInShop(Request $request)
    {
        if ($this->canShop('get_wrokers_in_shop') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $shop_id = $request->shop_id;
        $shop = Shop::find($shop_id);

        $shopWorkers =  $shop->shopWorkers()->get();

        return ShopWorker::collection($shopWorkers);
    }

    public function getShopWarehouse(Request $request)
    {
        if ($this->canShop('get_shop_warehouse') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $shop_id = $request->shop_id;
        $shop = Shop::find($shop_id);

        $warehouse = $shop->warehouse;

        return  new WarehouseResource($warehouse);
    }

    // public function getShopAddress(Request $request)
    // {
    //     $shop_id = $request->shop_id;

    //     $address = Shop::find($shop_id);

    //     $address = $address->address;

    //     return new AddressResource($address);
    // }

    public function getShopDetails(Request $request)
    {
        if ($this->canShop('get_shop_all_detailes') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $shop_id = $request->shop_id;

        $shop = Shop::find($shop_id);

        $shopWorkers =  $shop->shopWorkers()->get();
        $address = $shop->address;
        $warehouse = $shop->warehouse;
        $products = $shop->products()->get();

        $shop = [$shopWorkers, $warehouse, $products, $address];

        return $shop;
    }
};
