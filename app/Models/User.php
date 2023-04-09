<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
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

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function businessCustomer()
    {
        return $this->hasOne(BusinessCustomer::class);
    }

    /**
     * @param  mixed  $roles
     */
    public function checkRoles($roles): void
    {
        if (! is_array($roles)) {
            $roles = [$roles];
        }
        if (! $this->hasAnyRole($roles)) {
            auth()->logout();
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param  mixed  $roles
     */
    public function hasAnyRole($roles): bool
    {
        return (bool) $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * @param  mixed  $role
     */
    public function hasRole($role): bool
    {
        return (bool) $this->roles()->where('name', $role)->first();
    }
}
