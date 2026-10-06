<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. Lấy danh sách danh mục
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    // 2. Thêm mới danh mục
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return response()->json([
            'message' => 'Thêm danh mục thành công!',
            'data' => new CategoryResource($category)
        ], 201);
    }

    // 3. Xem chi tiết 1 danh mục
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    // 4. Cập nhật danh mục (Sửa)
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json([
            'message' => 'Cập nhật danh mục thành công!',
            'data' => new CategoryResource($category)
        ]);
    }

    // 5. Xóa danh mục
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Xóa danh mục thành công!'
        ], 200);
    }
}
