<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $table = 'airlines';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'price',
    ];

    public $timestamps = false;
}
