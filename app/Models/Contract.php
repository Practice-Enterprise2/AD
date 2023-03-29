<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;


    protected $table = 'contracts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'airline_id',
        'start_date',
        'end_date',
        'price',
        'airport_id',
        'depart_location',
        'destination_location',
        'created_at',
        'updated_at'
    ];
public $timestamps = false;
}
?>
