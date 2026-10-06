<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // GET /api/brands
    public function index()
    {
        $brands = Brand::latest()->get();

        return BrandResource::collection($brands);
    }

    // POST /api/brands
    public function store(BrandRequest $request)
    {
        $brand = Brand::create($request->validated());

        return response()->json([
            'message' => 'Thêm thương hiệu thành công',
            'data' => new BrandResource($brand)
        ], 201);
    }

    // GET /api/brands/{brand}
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    // PUT/PATCH /api/brands/{brand}
    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
            'logo' => 'nullable|string|max:255',
        ]);

        $brand->update($data);

        return response()->json([
            'message' => 'Cập nhật thương hiệu thành công',
            'data' => new BrandResource($brand)
        ]);
    }

    // DELETE /api/brands/{brand}
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'message' => 'Xóa thương hiệu thành công'
        ]);
    }
}