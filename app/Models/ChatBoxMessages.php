<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

class ChatBoxMessages extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

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
