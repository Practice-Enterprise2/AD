<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    use AppValidatesAttributes, HasFactory;

    const VALIDATION_RULE_LENGTH = ['required', 'gt:0', 'numeric'];

    const VALIDATION_RULE_WIDTH = ['required', 'gt:0', 'numeric'];

    const VALIDATION_RULE_HEIGHT = ['required', 'gt:0', 'numeric'];

    const VALIDATION_RULES = [
        'length' => self::VALIDATION_RULE_LENGTH,
        'width' => self::VALIDATION_RULE_WIDTH,
        'height' => self::VALIDATION_RULE_HEIGHT,
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
