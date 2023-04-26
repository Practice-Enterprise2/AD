<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class review extends Model
{
    use HasFactory;
    /**
     * Attributes to guard against mass-assignment.
     *
     * @var array
     */
    protected $guarded = [];

    protected $fillable = [
        'rating',
        'comment'
    ];


}
