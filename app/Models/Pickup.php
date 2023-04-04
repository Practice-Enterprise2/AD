<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
 * Model for the `pickups` table.
 */
class Pickup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'time',
        'status',
    ];

    /*
     * The address where the pickup happens.
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /*
     * The shipment that this is a pickup for.
     */
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
