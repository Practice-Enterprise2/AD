<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $rating
 * @property string $comment
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Review extends Model
{
    protected $fillable = [
        'rating',
        'comment',
    ];
}
