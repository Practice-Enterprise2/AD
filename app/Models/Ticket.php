<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ticketID
 * @property int $cstID
 * @property int $employeeID
 * @property string $issue
 * @property string $description
 * @property string $solution
 * @property string $status
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Ticket extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_ISSUE = ['required'];

    public const VALIDATION_RULE_DESCRIPTION = ['required'];

    public const VALIDATION_RULE_SOLUTION = ['required'];

    public const VALIDATION_RULE_STATUS = ['required'];

    public const VALIDATION_RULES = [
        'issue' => self::VALIDATION_RULE_ISSUE,
        'description' => self::VALIDATION_RULE_DESCRIPTION,
        'solution' => self::VALIDATION_RULE_SOLUTION,
        'status' => self::VALIDATION_RULE_STATUS,
    ];

    protected $primaryKey = 'ticketID';

    protected $fillable = [
        'cstID',
        'employeeID',
        'issue',
        'description',
        'solution',
        'status',
    ];
}
