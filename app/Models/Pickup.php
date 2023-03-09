<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * Model for the `pickups` table.
 */
class Pickup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'street',
        'house_number',
        'postal_code',
        'city',
        'region',
        'country',
        'time',
        'status',
    ];

}
