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
    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';


    protected $fillable = [
        'name',
        'shipment_date',
        'delivery_date',
        'weight',
        'status',
    ];
    
    public $sortable = [
        'id',
        'name',
        'shipment_date',
        'delivery_date',
        'weight',
        'status',
    ];

    public $timestamps = false;
}
