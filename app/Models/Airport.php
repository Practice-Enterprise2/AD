<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $iata_code
 * @property string $name
 * @property string $land
 * @property Address $address
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property ?\Illuminate\Support\Carbon $deleted_at
 */
class Airport extends Model
{
    protected $fillable = [
        'iata_code',
        'name',
        'land',
    ];
}
