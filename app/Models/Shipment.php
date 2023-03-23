<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'from_name',
        'from_phone',
        'from_address',
        'from_postalcode',
        'from_city',
        'from_country',
        'to_name',
        'to_phone',
        'to_address',
        'to_postalcode',
        'to_city',
        'to_country',
        'weight',
        'package_num',
        'price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
