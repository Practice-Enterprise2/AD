<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirlineContract extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'airline_id',
        'depart_airport_id',
        'destination_airport_id',
        'start_date',
        'end_date',
        'price',
        'is_active',
    ];

    public $timestamps = true;
}
