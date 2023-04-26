<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property ?Address $address
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property ?\Illuminate\Support\Carbon $email_verified_at
 * @property string $password
 * @property ?string $phone
 * @property int $role
 * @property ?string $remember_token
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property ?\Illuminate\Support\Carbon $deleted_at
 * @property bool $is_locked
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, SoftDeletes, HasRoles;

    public const VALIDATION_RULE_NAME = 'required|min:2';

    public const VALIDATION_RULE_LAST_NAME = 'required|min:2';

    public const VALIDATION_RULE_EMAIL = 'required|email';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'role',
        'is_locked',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasDirectPermission($permission): bool
    {
        $permission = $this->filterPermission($permission);

        foreach ($this->permissions as $permission) {
            if (collect($permission->flattened_up())->contains($permission->getKeyName(), $permission->getKey())) {
                return true;
            }
        }

        return false;
    }

    protected function hasPermissionViaRole(Permission $permission): bool
    {
        foreach ($permission->flattened_up() as $flat_permission) {
            if ($this->hasRole($flat_permission->roles)) {
                return true;
            }
        }

        return false;
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function businessCustomer(): HasOne
    {
        return $this->hasOne(BusinessCustomer::class);
    }
}
