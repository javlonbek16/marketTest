<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        if ($this->canWarehouse('create_category') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $category = Category::create($request->validated());

        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        if (!$category)

            return response()->json(['message' => 'Category not found'], 404);

        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($this->canWarehouse('update_category') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $category->update($request->validated());

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        if ($this->canWarehouse('delete_category') != 'can')

            return response()->json(['message' => ['forbidden' => ['Amalyotga huquq yo\'q']]], 403);

        $category->delete();

        return new CategoryResource($category);
    }
}
