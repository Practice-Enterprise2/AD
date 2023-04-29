<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBoxMessages extends Model
{
    protected $fillable = [
        'content',
    ];

    public function fromChatBox()
    {
        return $this->belongsTo(ChatBox::class);
    }

    public function fromWho()
    {
        return $this->belongsTo(User::class);
    }
}
