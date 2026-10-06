<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    // Danh sách các trạng thái hợp lệ của đơn hàng
    private $allowedStatuses = [
        'Chờ xác nhận',
        'Đã xác nhận',
        'Đang giao',
        'Đã giao',
        'Đã hủy'
    ];

    // 1. Lấy danh sách tất cả đơn hàng (kèm thông tin khách hàng)
    public function index()
    {
        $orders = Order::with('user')->get();
        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    // 2. Thêm mới một đơn hàng (Tạo đơn hàng)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'status' => ['nullable', Rule::in($this->allowedStatuses)],
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Nếu không truyền status, mặc định sẽ là 'Chờ xác nhận' (đã định nghĩa trong migration)
        $order = Order::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tạo đơn hàng thành công',
            'data' => $order
        ], 201);
    }

    // 3. Lấy chi tiết một đơn hàng theo ID
    public function show(string $id)
    {
        $order = Order::with('user')->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    // 4. Cập nhật thông tin đơn hàng hoặc thay đổi trạng thái
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'total' => 'sometimes|numeric|min:0',
            'status' => ['sometimes', Rule::in($this->allowedStatuses)],
            'address' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
        ]);

        $order->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật đơn hàng thành công',
            'data' => $order
        ], 200);
    }

    // 5. Xóa đơn hàng
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa đơn hàng thành công'
        ], 200);
    }
}