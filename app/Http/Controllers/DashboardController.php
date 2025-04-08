<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use DB;
class DashboardController extends Controller
{
    public function index()
    {
        // Tính tổng total của tất cả các đơn hàng
        $totalRevenue = Order::sum('total');
        // Tính tổng total của tất cả các đơn hàng trong ngày hiện tại
        $today = Carbon::today();
        $totalRevenueToday = Order::whereDate('created_at', $today)->sum('total');

        // Tính tổng total của tất cả các đơn hàng trong tháng hiện tại
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $totalRevenueThisMonth = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total');

        // Tính tổng số lượng users
        $totalUsers = User::count();

        // Tính tổng số lượng sản phẩm
        $totalProducts = Product::count();

        // Tính tổng số lượng đơn hàng
        $totalOrders = Order::count();

        // Lấy top 5 khách hàng có tổng giá trị mua hàng cao nhất
        $topUsers = Order::select('user_id', DB::raw('COUNT(*) as order_count'), DB::raw('SUM(total) as total_value'))
            ->groupBy('user_id')
            ->orderBy('total_value', 'desc')
            ->take(5)   
            ->get();

        // Lấy thông tin chi tiết của từng user
        $topUsers = $topUsers->map(function ($user) {
            $userDetails = User::find($user->user_id);
            return [
                'id' => $userDetails->id,
                'name' => $userDetails->name,
                'email' => $userDetails->email,
                'order_count' => $user->order_count,
                'total_value' => $user->total_value,
            ];
        });

        // Tính tổng doanh thu trong ngày hiện tại
        $totalRevenueToday = Order::whereDate('created_at', Carbon::today())->sum('total');

        // Lấy doanh thu theo từng ngày trong tuần
        $revenueByDay = [];
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($daysOfWeek as $day) {
            $revenueByDay[] = Order::whereDay('created_at', Carbon::parse($day)->day)->sum('total');
        }

        // Truyền dữ liệu vào view
        return view('viewAdmin.dashboard', compact(
            'totalRevenue',
            'totalRevenueToday',
            'totalRevenueThisMonth',
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'revenueByDay',
            'topUsers'
        ));
    }
}