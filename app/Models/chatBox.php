<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBox extends Model
{
 

    protected $fillable = [
        'customer_id',
        'employee_user_id',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_user_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatBoxMessages::class);
    }
}
