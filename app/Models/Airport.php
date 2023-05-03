<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $iata_code
 * @property string $name
 * @property string $land
 * @property Address $address
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property ?\Illuminate\Support\Carbon $deleted_at
 */
class Airport extends Model implements ValidatesAttributes
{
    use SoftDeletes, AppValidatesAttributes;

    public const VALIDATION_RULE_IATA_CODE = ['required', 'max:3'];

    public const VALIDATION_RULE_NAME = ['required'];

    public const VALIDATION_RULE_LAND = ['required'];

    public const VALIDATION_RULES = [
        'iata_code' => self::VALIDATION_RULE_IATA_CODE,
        'name' => self::VALIDATION_RULE_NAME,
        'land' => self::VALIDATION_RULE_LAND,
    ];

    protected $fillable = [
        'iata_code',
        'name',
        'land',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function airlines(): BelongsToMany
    {
        return $this->belongsToMany(Airline::class);
    }
}
