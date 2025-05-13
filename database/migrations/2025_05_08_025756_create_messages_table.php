<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chatbox_id'); // ID của cuộc trò chuyện
            $table->unsignedBigInteger('sender_id'); // ID người gửi
            $table->string('sender_type'); // Loại người gửi: 'admin' hoặc 'user'
            $table->text('message'); // Nội dung tin nhắn
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
