use App\Http\Controllers\HomeController;
<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdersAdminController;
use App\Http\Controllers\ReturnsOrderAdminController;
use App\Http\Controllers\ReturnsOrderManagerController;
use App\Http\Controllers\ReturnsOrderDetailAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProductsController;

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



Route::get('/products/search', [ProductsController::class, 'searchProducts'])->name('products.search');
