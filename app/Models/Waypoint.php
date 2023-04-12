<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Waypoint extends Model
{
    use HasFactory;

    protected $fillable = [
        // implement later.
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function current_address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'current_address_id', 'id');
    }

    public function next_address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'next_address_id', 'id');
    }
}
