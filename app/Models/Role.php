<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @property int $id
 * @property string $name
 * @property ?string $description
 * @property string $guard_name
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Role extends SpatieRole implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_NAME = ['required', 'min:1'];

    public const VALIDATION_RULE_DESCRIPTION = ['min:1'];

    public const VALIDATION_RULE_GUARD_NAME = ['required', 'min:1'];

    public const VALIDATION_RULES = [
        'name' => self::VALIDATION_RULE_NAME,
        'description' => self::VALIDATION_RULE_DESCRIPTION,
        'guard_name' => self::VALIDATION_RULE_GUARD_NAME,
    ];

    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];
}
