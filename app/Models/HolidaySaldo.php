<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Contract $contract
 * @property int $allowed_days
 * @property \Illuminate\Support\Carbon $year
 * @property string $type
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class HolidaySaldo extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_ALLOWED_DAYS = ['required'];

    public const VALIDATION_RULE_YEAR = ['required'];

    public const VALIDATION_RULE_TYPE = ['required'];

    public const VALIDATION_RULES = [
        'allowed_days' => self::VALIDATION_RULE_ALLOWED_DAYS,
        'year' => self::VALIDATION_RULE_YEAR,
        'type' => self::VALIDATION_RULE_TYPE,
    ];

    protected $fillable = [
        'allowed_days',
        'year',
        'type',
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
