<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property mixed $notifiable
 * @property string $data
 * @property ?\Illuminate\Support\Carbon $read_at
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Notification extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_TYPE = ['required'];

    public const VALIDATION_RULE_DATA = ['required'];

    public const VALIDATION_RULES = [
        'type' => self::VALIDATION_RULE_TYPE,
        'data' => self::VALIDATION_RULE_DATA,
    ];

    public $incrementing = false;

    protected $fillable = [
        'type',
        'data',
        'read_at',
    ];

    // Since polymorphic relations can technically refer to anything, the
    // inverse for this one isn't implemented.
    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
