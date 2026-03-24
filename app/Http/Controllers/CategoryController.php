<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        // El id insertado lo sacamos con create
        $category = Category::create($request->validated());

        return response()->json([
            'success' => true,
            'category' => $category,
        ]);
    }
}
