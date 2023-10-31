<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Http\Resources\WarehouseResource;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {

        $products = Product::all();

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {

        if ($this->canWarehouse('create_product') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $product = Product::create($request->validated());

        return new ProductResource($product);
    }

    public function show(Product $product)
    {

        if (!$product)

            return response()->json(['message' => 'Product not found'], 404);

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {

        if ($this->canWarehouse('update_product') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $product->create($request->validated());

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        if ($this->canWarehouse('delete_product') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $product->delete();

        return new ProductResource($product);
    }

    public function getWarehouseOftheProduct(Product $warehouse, Request $request)
    {

        if ($this->canWarehouse('get_product_in_warehouse') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $product_id = $request->product_id;

        $product = Product::find($product_id);

        $warehouse = $product->warehouse;

        if (!$warehouse)

            return response()->json(['message' => 'this product is not create or is not available in the Warehouse'], 404);

        return new WarehouseResource($warehouse);
    }

    public function getShopOftheProduct(Product $shop, Request $request)
    {

        if ($this->canWarehouse('get_shop_of_the_product') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $product_id = $request->product_id;

        $product = Product::find($product_id);

        $shop = $product->shop;

        if (!$shop)

            return response()->json(['message' => 'this product is not create or is not available in the Shop'], 404);

        return new ShopResource($shop);
    }
}
