<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Contract $contract
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property string $status
 * @property \Illuminate\Support\Carbon $approval_time
 * @property string $type
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Absence extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_START_DATE = ['required', 'before_or_equal:end_date'];

    public const VALIDATION_RULE_END_DATE = ['required', 'after_or_equal:end_date'];

    public const VALIDATION_RULE_STATUS = ['required'];

    public const VALIDATION_RULE_APPROVAL_TIME = ['required'];

    public const VALIDATION_RULE_TYPE = ['required'];

    public const VALIDATION_RULES = [
        'start_date' => self::VALIDATION_RULE_START_DATE,
        'end_date' => self::VALIDATION_RULE_END_DATE,
        'status' => self::VALIDATION_RULE_STATUS,
        'approval_time' => self::VALIDATION_RULE_APPROVAL_TIME,
        'type' => self::VALIDATION_RULE_TYPE,
    ];

    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'approval_time',
        'type',
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
