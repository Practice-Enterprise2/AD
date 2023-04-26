<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Contract $contract
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property string $status
 * @property \Illuminate\Support\Carbon $approval_time
 * @property string $type
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Absence extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'approval_time',
        'type',
    ];
}
