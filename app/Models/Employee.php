<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property User $user
 * @property \Illuminate\Support\Carbon $dateOfBirth
 * @property string $jobTitle
 * @property int $salary
 * @property string $Iban
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property ?\Illuminate\Support\Carbon $deleted_at
 */
class Employee extends Model implements ValidatesAttributes
{
    use HasApiTokens, Notifiable, SoftDeletes, AppValidatesAttributes;

    public const VALIDATION_RULE_DATE_OF_BIRTH = ['required', 'date'];

    public const VALIDATION_RULE_JOB_TITLE = ['required'];

    public const VALIDATION_RULE_SALARY = ['required'];

    public const VALIDATION_RULE_IBAN = ['required'];

    public const VALIDATION_RULE_EMAIL = ['required', 'email'];

    public const VALIDATION_RULES = [
        'dateOfBirth' => self::VALIDATION_RULE_DATE_OF_BIRTH,
        'jobTitle' => self::VALIDATION_RULE_JOB_TITLE,
        'salary' => self::VALIDATION_RULE_SALARY,
        'Iban' => self::VALIDATION_RULE_IBAN,
        'email' => self::VALIDATION_RULE_EMAIL,
    ];

    protected $table = 'employees';

    protected $fillable = [
        'dateOfBirth',
        'jobTitle',
        'salary',
        'Iban',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employee_contracts(): HasMany
    {
        return $this->hasMany(EmployeeContract::class);
    }
}
