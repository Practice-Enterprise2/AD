<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property Employee $employee
 * @property \Illuminate\Support\Carbon $start_date
 * @property ?\Illuminate\Support\Carbon $end_date
 * @property ?\Illuminate\Support\Carbon $created_date
 * @property ?\Illuminate\Support\Carbon $updated_date
 */
class EmployeeContract extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class);
    }
}
