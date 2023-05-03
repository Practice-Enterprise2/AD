<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $session_id
 * @property ?User $user
 * @property \Illuminate\Support\Carbon $timestamp
 * @property string $path
 */
class Log extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_SESSION_ID = ['required'];

    public const VALIDATION_RULE_TIMESTAMP = ['required', 'date'];

    public const VALIDATION_RULE_PATH = ['required'];

    public const VALIDATION_RULES = [
        'session_id' => self::VALIDATION_RULE_SESSION_ID,
        'timestamp' => self::VALIDATION_RULE_TIMESTAMP,
        'path' => self::VALIDATION_RULE_PATH,
    ];

    public $timestamps = false;

    // Can't set default date in $attributes as it's impossible to create as a
    // constant.

    protected $fillable = [
        'session_id',
        'timestamp',
        'path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
