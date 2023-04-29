<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    protected $fillable = [
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
