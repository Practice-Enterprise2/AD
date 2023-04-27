<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Position extends Model
{
    protected $fillable = [
        'name',
    ];

    public function employee_contracts(): BelongsToMany
    {
        return $this->belongsToMany(EmployeeContract::class);
    }
}
