<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contractlist extends Model
{

    use Sortable;
    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key

    protected $table = 'contracts';

    protected $primaryKey = 'contract_ID';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected $fillable = [
        'contract_ID',
        'airline_ID',
        'start_date',
        'end_date',
        'price',
        'depart_airport',
        'destination_airport',
    ];

    public $sortable = [
        'contract_ID',
        'airline_ID',
        'start_date',
        'end_date',
        'price',
        'depart_airport',
        'destination_airport',
    ];

    public $timestamps = false;
}
