<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Contract $contract
 * @property int $allowed_days
 * @property \Illuminate\Support\Carbon $year
 * @property string $type
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class HolidaySaldo extends Model
{
}
