<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property Address $source_address
 * @property Address $destination_address
 * @property \Illuminate\Support\Carbon $shipment_date
 * @property \Illuminate\Support\Carbon $delivery_date
 * @property int $expense
 * @property int $weight
 * @property string $type
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property User $user
 * @property ?\Illuminate\Support\Carbon $deleted_at
 * @property ?string $receiver_name
 * @property ?string $receiver_email
 * @property string $status
 * @property Dimension $dimension
 */
class Shipment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shipment_date',
        'delivery_date',
        'expense',
        'weight',
        'type',
        'receiver_name',
        'receiver_email',
        'status',
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
