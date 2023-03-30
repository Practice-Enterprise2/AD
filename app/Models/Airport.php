<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'IATA',
        'name',
        'land',
        'address_id',
        'created_at',
        'updated_at',
    ];
}
