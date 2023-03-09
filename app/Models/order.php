<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;


    /**
     * The orders that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'OrderID',
        'CustomerID',
        'CustomerName',
        'Item',
        'Quantity',
        'PurchaseDate',
        'Price',
    ];

    protected $primaryKey = 'OrderID';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'OrderID' => 'integer',
        'CustomerID' => 'integer',
        'CustomerName' => 'string',
        'Item' => 'string',
        'Quantity' => 'integer',
        'PurchaseDate' => 'datetime',
        'Price' => 'float',
    ];
}
