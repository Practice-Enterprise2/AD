<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_box_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatbox_id')->constrained('chat_boxes');
            $table->foreignId('from_id')->constrained('users');
            $table->string('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_box_messages');
    }
};
