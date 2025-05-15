<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra nếu admin chưa đăng nhập
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login'); // Chuyển hướng đến trang đăng nhập
        }

        return $next($request); // Cho phép truy cập nếu đã đăng nhập
    }
}