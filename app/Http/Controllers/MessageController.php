<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // Gửi tin nhắn
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'chatbox_id' => 'required|exists:chatboxes,id',
            'sender_id' => 'required',
            'sender_type' => 'required|in:admin,user',
            'message' => 'required|string',
        ]);

        $message = Message::create($validated);

        // Phát sự kiện real-time (nếu dùng Pusher hoặc Laravel Echo)
        broadcast(new \App\Events\MessageSent($message))->toOthers();

        return response()->json(['success' => true, 'message' => $message]);
    }

    // Lấy danh sách tin nhắn
    public function getMessages($chatboxId)
    {
        $messages = Message::where('chatbox_id', $chatboxId)
            ->orderBy('created_at', 'asc')
            ->paginate(20); // Lấy 20 tin nhắn mỗi lần

        return response()->json($messages);
    }
}