<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Airline extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_NAME = ['required'];

    public const VALIDATION_RULE_PRICE = ['required'];

    public const VALIDATION_RULES = [
        'name' => self::VALIDATION_RULE_NAME,
        'price' => self::VALIDATION_RULE_PRICE,
    ];

    protected $fillable = [
        'name',
        'price',
    ];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function airports(): BelongsToMany
    {
        return $this->belongsToMany(Airport::class);
    }
}
