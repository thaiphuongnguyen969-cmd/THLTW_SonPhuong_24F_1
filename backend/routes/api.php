<?php 

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Api\CategoryController; 
use App\Http\Controllers\Api\ProductController; 
use App\Http\Controllers\Api\UserController; 
use App\Http\Controllers\Api\AuthController; 
use App\Http\Controllers\Api\BrandController;

/* 
|-------------------------------------------------------------------------- 
| API Routes 
|-------------------------------------------------------------------------- 
*/ 

// 1. Các route công khai (Không cần token: Đăng ký, Đăng nhập) 
Route::post('/register', [AuthController::class, 'register']); 
Route::post('/login', [AuthController::class, 'login']); 

// (Tùy chọn) Nếu bạn muốn cho phép mọi người xem danh sách sản phẩm và danh mục mà không cần đăng nhập:
Route::apiResource('products', ProductController::class)->only(['index', 'show']); 
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']); 

// 2. Các route bảo mật yêu cầu Token (Middleware auth:sanctum cho toàn bộ Full CRUD còn lại) 
Route::middleware('auth:sanctum')->group(function () { 
    // Thông tin tài khoản đang đăng nhập & Đăng xuất
    Route::get('/me', [AuthController::class, 'me']); 
    Route::post('/logout', [AuthController::class, 'logout']); 
     
    Route::get('/user', function (Request $request) { 
        return $request->user(); 
    }); 
    Route::apiResource('brands', BrandController::class);
    Route::get('/brands/{name}', [BrandController::class, 'showByName']);

    // Full CRUD cho Categories (Thêm, Sửa, Xóa yêu cầu Token)
    Route::apiResource('categories', CategoryController::class); 

    // Full CRUD cho Products (Thêm, Sửa, Xóa yêu cầu Token)
    Route::apiResource('products', ProductController::class); 

    // Full CRUD cho Users (Xem, Thêm, Sửa, Xóa) 
    Route::apiResource('users', UserController::class); 
});