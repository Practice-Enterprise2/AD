<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBoxMessages extends Model
{
    protected $fillable = [
        'content',
    ];

    public function chatbox()
    {
        return $this->belongsTo(ChatBox::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
