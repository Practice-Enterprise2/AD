<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Shipment extends Model
{
    use HasFactory, SoftDeletes;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [ 
        'id',
        'name',
        'user_id',
        'source_address_id',
        'destination_address_id',
        'shipment_date',
        'delivery_date',
        'status',
        'expense',
        'weight',
        'type',
    ];

    public function pickups(): HasMany
    {
        return $this->hasMany(Pickup::class);
    }

    public function source_address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function destination_address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
