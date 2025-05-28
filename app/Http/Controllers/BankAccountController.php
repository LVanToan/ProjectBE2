<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BankAccountController extends Controller
{
    public function store(Request $request)
{
    $allowedBanks = ['vietcombank', 'techcombank', 'vietinbank', 'bidv', 'sacombank', 'mbbank'];
    $bankName = $request->bank_name;

    if (!in_array($bankName, $allowedBanks)) {
        return response()->json(['error' => 'Ngân hàng không khả dụng'], 400);
    }

    $user_id = Auth::id();
    if (!$user_id) {
        return response()->json(['error' => 'Bạn phải đăng nhập.'], 401);
    }

    try {
        $bankAccount = BankAccount::create([
            'user_id' => $user_id,
            'bank_name' => $bankName,
            'card_number' => $request->card_number,
            'card_holder_name' => $request->card_holder_name,
            'issue_date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->issue_date)->format('Y-m-d'),
            'expiry_date' => $request->expiry_date,
        ]);

        return response()->json([
            'success' => 'Tài khoản ngân hàng đã lưu.',
            'data' => $bankAccount // trả dữ liệu cho frontend
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Lỗi lưu dữ liệu.'], 500);
    }
}

}