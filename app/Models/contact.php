<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'email',
        'shipment_id',
        'subject',
        'message',
        'is_handled',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
