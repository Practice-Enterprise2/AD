<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    protected $fillable = [
        'email',
        'subject',
        'message',
        'is_handled',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
