<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;   

class Depot extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'depots';

    protected $fillable = [
        'code',
        'size',
        'amountfilled',
    ];

    protected $dates = ['deleted_at'];

}
