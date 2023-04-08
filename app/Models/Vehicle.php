<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'type',
        'license_plate',
        'start_location',
        'end_location',
        'status',
    ];

    use HasFactory;
}
