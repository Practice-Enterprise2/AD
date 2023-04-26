<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Airline extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
