<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waypoint extends Model
{
    use HasFactory;

    protected $fillable = [
        // implement later.
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function current_address()
    {
        return $this->belongsTo(Address::class, 'current_address_id', 'id');
    }

    public function next_address()
    {
        return $this->belongsTo(Address::class, 'next_address_id', 'id');
    }
}
