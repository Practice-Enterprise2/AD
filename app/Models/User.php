<?php

namespace App\Models;

use App\Contracts\Database\Eloquent\ValidatesAttributes;
use App\Database\Eloquent\ValidatesAttributes as AppValidatesAttributes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
class User extends Authenticatable implements MustVerifyEmail, ValidatesAttributes
{
    use HasApiTokens, Notifiable, SoftDeletes, HasRoles, AppValidatesAttributes, HasFactory;

    public const VALIDATION_RULE_NAME = ['required', 'min:2', 'string', 'regex:/^[A-Za-z\s]+$/'];

    public const VALIDATION_RULE_LAST_NAME = ['min:2'];

    public const VALIDATION_RULE_EMAIL = ['required', 'email', 'unique:users,email'];

    public const VALIDATION_RULE_EMAIL_VERIFIED_AT = ['date'];

    public const VALIDATION_RULE_PASSWORD = ['required'];

    public const VALIDATION_RULE_PHONE = [];

    public const VALIDATION_RULE_ROLE = [];

    public const VALIDATION_RULE_REMEMBER_TOKEN = [];

    public const VALIDATION_RULE_IS_LOCKED = ['boolean'];

    public const VALIDATION_RULES = [
        'name' => self::VALIDATION_RULE_NAME,
        'last_name' => self::VALIDATION_RULE_LAST_NAME,
        'email' => self::VALIDATION_RULE_EMAIL,
        'email_verified_at' => self::VALIDATION_RULE_EMAIL_VERIFIED_AT,
        'password' => self::VALIDATION_RULE_PASSWORD,
        'phone' => self::VALIDATION_RULE_PHONE,
        'role' => self::VALIDATION_RULE_ROLE,
        'remember_token' => self::VALIDATION_RULE_REMEMBER_TOKEN,
        'is_locked' => self::VALIDATION_RULE_IS_LOCKED,
    ];

    protected $attributes = [
        'last_name' => '',
        'role' => 0,
        'is_locked' => 0,
    ];

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

    public function business_customer(): HasOne
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

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    /**
     * Return a collection of unique permissions granted to this user. This
     * method takes all the ways permissions can be granted into account. The
     * permissions are also flattened (which makes sure transitive permissions
     * are expanded further to their granted subpermissions as well). Basically
     * this returns all the permissions that would return `true` when asked
     * 'does this user have this permission'.
     *
     * @return \Illuminate\Database\Eloquent\Collection<string, Permission>
     */
    public function get_permissions(): Collection
    {
        $flat_direct_permissions = new Collection;
        $flat_role_permissions = new Collection;
        $direct_permissions = $this->permissions;
        foreach ($direct_permissions as $direct_permission) {
            $flat_direct_permissions = $flat_direct_permissions->concat($direct_permission->flattened_down());
        }
        $role_permissions = $this->getPermissionsViaRoles();

        /*
         * @var \App\Models\Permission $role_permission
         */
        foreach ($role_permissions as $role_permission) {
            $flat_role_permissions = $flat_role_permissions->concat($role_permission->flattened_down());
        }
        $flat_direct_permissions = $flat_direct_permissions->concat($flat_role_permissions);

        return $flat_direct_permissions->unique();
    }
}
