<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class RevenueController extends Controller
{
    public function index(Request $request)
    {
        // Lấy dữ liệu từ request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Nếu có ngày bắt đầu và ngày kết thúc, lọc đơn hàng theo khoảng thời gian
        if ($startDate && $endDate) {
            $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            // Hiển thị tất cả đơn hàng nếu không có ngày được chọn
            $orders = Order::all();
        }

        // Tính toán tổng doanh thu và các thông tin khác
        $totalRevenue = $orders->where('status', 'delivered')->sum('total');
        $totalOrders = $orders->count();
        $successfulOrders = $orders->where('status', 'delivered')->count();
        $canceledOrders = $orders->where('status', 'canceled')->count();
        return view('viewAdmin.revenue_manager', compact('totalRevenue', 'totalOrders', 'successfulOrders', 'canceledOrders', 'orders'));
    }
    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            // Lọc đơn hàng theo khoảng thời gian
            $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();

            // Tính toán lại các thông tin
            $totalRevenue = $orders->where('status', 'delivered')->sum('total');
            $totalOrders = $orders->count();
            $successfulOrders = $orders->where('status', 'delivered')->count();
            $canceledOrders = $orders->where('status', 'canceled')->count();

            // Trả về dữ liệu dưới dạng JSON
            return response()->json([
                'totalRevenue' => $totalRevenue,
                'totalOrders' => $totalOrders,
                'successfulOrders' => $successfulOrders,
                'canceledOrders' => $canceledOrders,
                'orders' => $orders,
            ]);
        }

        return response()->json(['error' => 'Vui lòng chọn ngày hợp lệ.'], 400);
    }
}