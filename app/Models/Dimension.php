<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $length
 * @property int $width
 * @property int $height
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Dimension extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    const VALIDATION_RULES = [
        'length' => ['required', 'gt:0', 'numeric'],
        'width' => ['required', 'gt:0', 'numeric'],
        'height' => ['required', 'gt:0', 'numeric'],
    ];

    protected $fillable = [
        'length',
        'width',
        'height',
    ];

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }
}
