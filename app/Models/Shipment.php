<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'shipment_date',
        'delivery_date',
        'expense',
        'weight',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
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

    public function user_id(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function waypoints(): HasMany
    {
        return $this->hasMany(Waypoint::class);
    }
}
