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

    protected $fillable = [
        'rating',
        'comment',
    ];
}
