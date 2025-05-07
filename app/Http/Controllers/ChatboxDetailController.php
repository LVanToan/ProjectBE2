<?php

namespace App\Http\Controllers;

use App\Models\ChatboxData;
use Illuminate\Http\Request;

class ChatboxDetailController extends Controller
{
    public function show($id)
    {
        // Lấy dữ liệu chi tiết của chatbox từ database
        $chatboxData = ChatboxData::findOrFail($id);

        // Trả về view với dữ liệu
        return view('viewAdmin.chatbox-detail', compact('chatboxData'));
    }
}