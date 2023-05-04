<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class airport extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'airports';

    protected $primaryKey = 'id';

    protected $fillable = [
        'iata_code',
        'name',
        'land',
        'address_id',

    ];

    public $sortable = [
        'id',
        'iata_code',
        'name',
        'land',
        'address_id',
    ];

    // public $timestamps = false;
}
