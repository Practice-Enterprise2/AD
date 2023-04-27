<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class airport extends Model
{
    use HasFactory;
    use Sortable;

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $table = 'airports';

    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'land',
        'address_id',

    ];

    public $sortable = [
        'id',
        'name',
        'land',
        'address_id',
    ];

    public $timestamps = false;
}
