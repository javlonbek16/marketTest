<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\WorkResource;
use App\Models\Product;
use App\Models\Work;
use Illuminate\Http\Request;

class SearchesController extends Controller
{

    public function SearchProductName(Request $request)
    {
        $productName = $request->input('product_name');

        $products = Product::where('name', 'LIKE', "%$productName%")->get();

        if (!$products)
            return response()->json(['message' => 'Product not found'], 404);

        return ProductResource::collection($products);
    }

    public function SearchWorkName(Request $request)
    {
        $work_name = $request->input('work_name');

        $works = Work::where('work_name', 'LIKE', "%$work_name%")->get();

        if (!$works)
            return response()->json(['message' => 'Work not found'], 404);

        return WorkResource::collection($works);
    }
}
