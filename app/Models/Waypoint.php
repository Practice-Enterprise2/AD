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
}
