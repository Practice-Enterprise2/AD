<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $code
 * @property Address $address
 * @property int $size
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Depot extends Model
{
    protected $fillable = [
        'code',
        'size',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
