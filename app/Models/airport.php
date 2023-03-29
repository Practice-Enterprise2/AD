<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class airport extends Model
{
    use HasFactory;

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $table = 'airports';
    protected $primaryKey = 'iataCode';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';


    protected $fillable = [
        'airportName',
        'iataCode',
        'stateCode',
        'countryCode',
        'countryName',
    ];
    
    // old DB with int as key
    // protected $primaryKey ="airportID";
    // // protected $fillable = ['name', 'code', 'stateCode', 'countryCode', 'countryName'];

    public $timestamps = false;
}
?>