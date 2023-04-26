<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $session_id
 * @property ?User $user
 * @property \Illuminate\Support\Carbon $timestamp
 * @property string $path
 */
class Log extends Model
{
}
