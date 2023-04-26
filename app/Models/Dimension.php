<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $length
 * @property int $width
 * @property int $height
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Dimension extends Model
{
    protected $fillable = [
        'length',
        'width',
        'height',
    ];

    public function shipment()
    {
        return $this->belongsTo('App\Models\Shipment');
    }
}
