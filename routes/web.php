<?php

use App\Http\Controllers\CustomerListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdersAdminController;
use App\Http\Controllers\ReturnsOrderAdminController;
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
