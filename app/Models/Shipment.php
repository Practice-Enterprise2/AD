<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    protected $table = 'shipments';

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'shipment_date',
        'delivery_date',
        'status',
        'expense',
        'weight',
        'type',
        'receiver_name',
        'receiver_email',
    ];

    public function pickups(): HasMany
    {
        return $this->hasMany(Pickup::class);
    }

    // public function source_address(): BelongsTo
    // {
    //     return $this->belongsTo(Address::class);
    // }

    // public function destination_address(): BelongsTo
    // {
    //     return $this->belongsTo(Address::class);
    // }

    public function source_address(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'source_address_id');
    }

    public function destination_address(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'destination_address_id');
    }

    public function waypoints(): HasMany
    {
        return $this->hasMany(Waypoint::class);
    }
}
