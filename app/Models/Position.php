<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Position extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_NAME = ['required'];

    public const VALIDATION_RULES = [
        'name' => self::VALIDATION_RULE_NAME,
    ];

    protected $fillable = [
        'name',
    ];

    public function employee_contracts(): BelongsToMany
    {
        return $this->belongsToMany(EmployeeContract::class);
    }
}
