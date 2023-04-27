<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    public const VALIDATION_RULE_NAME = 'required|min:2';

    public const VALIDATION_RULE_LAST_NAME = 'required|min:2';

    public const VALIDATION_RULE_EMAIL = 'required|email';

    protected $fillable = [
        'address_id',
        'name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
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

    //checks if you changed the user name and sends an verification email
    public function setNameAttribute($value)
    {
        // check if the user is logged in
        if (auth()->check()) {
            // check if the name has changed
            if ($value !== $this->name) {
                $this->attributes['name'] = $value;
                $this->attributes['email_verified_at'] = null;
                $this->sendEmailVerificationNotification();
            }
        }

        $this->attributes['name'] = $value;
    }
}
