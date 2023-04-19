<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'weight',
        'due_date',
        'total_price',
        'total_price_excl_vat',
        'invoice_code',
    ];
}
