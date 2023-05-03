<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @property int $id
 * @property string $name
 * @property ?string $description
 * @property string $guard_name
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];
}
