<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $rating
 * @property string $comment
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Review extends Model implements ValidatesAttributes
{
    use AppValidatesAttributes;

    public const VALIDATION_RULE_RATING = ['required', 'gte:0', 'lte:5', 'numeric'];

    public const VALIDATION_RULE_COMMENT = ['min:1'];

    public const VALIDATION_RULES = [
        'rating' => self::VALIDATION_RULE_RATING,
        'comment' => self::VALIDATION_RULE_COMMENT,
    ];

    protected $fillable = [
        'rating',
        'comment',
    ];
}
