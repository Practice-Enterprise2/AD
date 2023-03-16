<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Shipment extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected $fillable = [ 
        'id',
        'name',
        'CustomerID',
        'source_address_id',
        'destination_address_id',
        'shipment_date',
        'delivery_date',
        'status',
        'expense',
        'weight',
        'type',
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'source_address_id' => 'integer',
        'destination_address_id' => 'integer',
        'shipment_date' => 'datetime',
        'delivery_date' => 'datetime',
        'status' => 'integer',
        'expense' => 'integer',
        'weight' => 'integer',
        'type' => 'string',
    ];
}
