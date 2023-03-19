<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class shipment extends Model
{
    use HasFactory;
    use Sortable;

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $table = 'shipments';
    protected $primaryKey = 'ShipmentID';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';


    protected $fillable = [
        'ShipmentName',
        'ShipmentDate',
        'DeliveryDate',
        'ShipmentWeight',
        'ShipmentStatus',
    ];
    
    public $sortable = [
        'ShipmentID',
        'ShipmentName',
        'ShipmentDate',
        'DeliveryDate',
        'ShipmentWeight',
        'ShipmentStatus',
    ];

    public $timestamps = false;
}
