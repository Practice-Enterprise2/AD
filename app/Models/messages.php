<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'chatbox_id',
        'from_id',
        'content'
    ];

    public function fromChatBox() {
        return $this->belongsTo(chatBox::class);
    }
    public function fromWho() {
        return $this->belongsTo(User::class);
    }
}
