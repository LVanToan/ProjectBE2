<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderManagerController;
use App\Http\Controllers\OrdersDetailsController;
use App\Http\Controllers\OrdersAdminController; 
use App\Http\Controllers\ReturnsOrderAdminController;
use App\Http\Controllers\ReturnsOrderManagerController;
use App\Http\Controllers\ReturnsOrderDetailAdminController;
use App\Http\Controllers\ReturnsOrderController;
use App\Http\Controllers\OrderReturnResultsController;

use Illuminate\Support\Facades\Route;
    
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Giao diện trang admin
// Giao diện trang chủ admin
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
// Giao diện quản lý đơn hàng
Route::get('/admin/orders', [OrdersAdminController::class, 'index'])->name('admin.orders');
// Giao diện quản lý khach hàng
Route::get('/admin/customers', [CustomerListController::class, 'index'])->name('admin.customers');
// Giao diện quản lý đơn hàng trả lại
Route::get('/admin/list_returns_orders', [ReturnsOrderAdminController::class, 'index'])->name('admin.returns_orders');
// Giao diện quản lý chi tiết đơn hàng trả lại
Route::get('admin/returns-orders/{id}', [ReturnsOrderDetailAdminController::class, 'show'])->name('admin.returns.orders.detail');
// Route lưu thông tin chi tiết hoàn trả
Route::post('/order-return-results/{id}/store', [OrderReturnResultsController::class, 'store']);
// Route lấy bảng thông báo đổi trả
Route::get('/api/order_return_results/{id}', [OrderReturnResultsController::class, 'getResults']);
// Route cập nhật trạng thái đơn hoàn trả
Route::post('/returns-orders/{id}/update-status', [ReturnsOrderManagerController::class, 'updateStatus']);
// Route xác nhận đổi trả
Route::post('/orders/{id}/product-received', [ReturnsOrderAdminController::class, 'productReceived']);


// Giao diện trang user
// Giao diện trang chủ website
Route::get('/home', [HomeController::class, 'show'])->name('home.show');
// Route dashboard
// Áp dụng middleware kiểm soát truy cậpp
Route::middleware(['access.control'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});

// Hiển thị form đăng nhập/ đăng ký
Route::get('/auth', function () {
    return view('viewUser.auth');
})->name('auth');
// Đăng nhập / Đăng ký / Đăng Xuất / Quên Mật Khẩu
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', function () {
    return redirect()->route('auth'); // hoặc return view('viewUser.auth');
})->name('login.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/ckeditor/upload', [App\Http\Controllers\CKEditorController::class, 'upload'])->name('ckeditor.upload');
// Router để hiển thị trang quản lý đơn hàng
Route::get('/order-manager', [OrderManagerController::class, 'show'])->name('order.manager.show');
Route::get('/orders/{id}/detail', [OrdersDetailsController::class, 'show'])->name('orders.detail');
Route::post('/orders/{id}/update', [OrdersDetailsController::class, 'update'])->name('order.update');
// Router để hiện thị trang đổi form trả hàng 
Route::get('/returns-order/{id}', [ReturnsOrderController::class, 'showReturnOrderForm'])->name('order.returns');
Route::post('/returns_order', [ReturnsOrderController::class, 'store'])->name('returns_order.store');
// Giao diện trang danh sách đơn hàng đổi trả
Route::get('/returns-order-manager', [ReturnsOrderManagerController::class, 'index'])->name('returns_order_manager');