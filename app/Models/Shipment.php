<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{

    use HasFactory;
    protected $table = 'shipments';

    protected $fillable = [
        'id', 'status',
    ];
}
