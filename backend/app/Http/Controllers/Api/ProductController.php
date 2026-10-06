<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Lấy danh sách sản phẩm (kèm thông tin danh mục)
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products, 200);
    }

    // Thêm mới sản phẩm
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::create($validated);
        return response()->json([
            'message' => 'Thêm sản phẩm thành công',
            'data' => $product
        ], 201);
    }

    // Lấy chi tiết một sản phẩm (Dùng Route Model Binding)
    public function show(Product $product)
    {
        // Laravel sẽ tự động tìm theo ID hoặc theo 'name' tùy vào URL bạn truyền vào
        return response()->json($product->load('category'), 200);
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:200',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'image' => 'nullable|string|max:255',
            'quantity' => 'sometimes|integer|min:0',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Cập nhật sản phẩm thành công',
            'data' => $product
        ], 200);
    }

    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Xóa sản phẩm thành công'], 200);
    }
}