<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;


    protected $table = 'contracts';
    protected $primaryKey = 'contract_ID';

    protected $fillable = [
        'contract_ID',
        'airline_ID',
        'start_date',
        'end_date',
        'price',
        'depart_airport',
        'destination_airport',
        'active',
    ];
public $timestamps = false;
}
?>
