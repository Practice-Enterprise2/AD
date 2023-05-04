<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property Employee $employee
 * @property \Illuminate\Support\Carbon $start_date
 * @property ?\Illuminate\Support\Carbon $end_date
 * @property ?\Illuminate\Support\Carbon $created_date
 * @property ?\Illuminate\Support\Carbon $updated_date
 */
class EmployeeContract extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_START_DATE = ['before_or_equal:end_date'];

    public const VALIDATION_RULE_END_DATE = ['after_or_equal:start_date'];

    public const VALIDATION_RULES = [
        'start_date' => self::VALIDATION_RULE_START_DATE,
        'end_date' => self::VALIDATION_RULE_END_DATE,
    ];

    protected $fillable = [
        'start_date',
        'end_date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class);
    }
}
