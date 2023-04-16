<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimensions extends Model
{
    use HasFactory;
    protected $fillable = ['length', 'width', 'height'];

    public function shipment()
    {
        return $this->belongsTo('App\Models\Shipment');
    }
}
