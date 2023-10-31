<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopWorker;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ShopWorkers;
use Illuminate\Http\Request;

class FilltersController extends Controller
{
    public function filterProductCategory(Request $request)
    {
        $categoryName = $request->input('category_name');

        $category = Category::where('category_name', $categoryName)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $products = Product::where('category_id', $category->id)->get();

        return ProductResource::collection($products);
    }
    public function filterProductDiscount(Request $request)
    {
        $percent = $request->input('perecent');

        $discount = Discount::where('perecent', $percent)->first();

        if (!$discount) {
            return response()->json(['message' => 'Discount not found'], 404);
        }

        $products = Product::where('discount_id', $discount->id)->get();

        return ProductResource::collection($products);
    }


    public function filterProductPrice(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();

        return ProductResource::collection($products);
    }

    public function filterSalledProduct()
    {
        $products = Product::where('sale_or_not', true)->get();

        return ProductResource::collection($products);
    }

    public function filterSallesProduct()
    {
        $products = Product::where('sale_or_not', false)->get();

        return ProductResource::collection($products);
    }

    // public function filterShopWorkerSallary()
    // {
    //     $shopWorkers = ShopWorkers::get();
    //     $shopw =  $shopWorkers->user();
    //    return $shopw;
    // }

    // public function filterWarehousepWorkerSallary()
    // {
    // }

    // public function filterOfficeWorkerSallary()
    // {
    // }
}
