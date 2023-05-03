<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $btw
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Company extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_NAME = ['required'];

    public const VALIDATION_RULE_BTW = ['required', 'numeric'];

    public const VALIDATION_RULES = [
        'name' => self::VALIDATION_RULE_NAME,
        'btw' => self::VALIDATION_RULE_BTW,
    ];

    protected $fillable = [
        'name',
        'btw',
    ];
}
