<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $session_id
 * @property ?User $user
 * @property \Illuminate\Support\Carbon $timestamp
 * @property string $path
 */
class Log extends Model
{
    public $timestamps = false;

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
