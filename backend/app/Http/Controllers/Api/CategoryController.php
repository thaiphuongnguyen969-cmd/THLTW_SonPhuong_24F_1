<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. Lấy danh sách danh mục
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    // 2. Thêm mới danh mục
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return new CategoryResource($category);
    }

    // Các hàm show, update, destroy tương tự...
}