<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    /**
     * The permissions granted by this permission.
     */
    public function grants(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_grants_permission', 'main_permission_id', 'granted_permission_id');
    }

    /**
     * The permissions that grant this permission.
     */
    public function granted_by(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_grants_permission', 'granted_permission_id', 'main_permission_id');
    }

    /**
     * Returns all the superpermissions that grant this permission, all the
     * way to the leaves (the ones that aren't granted by any other
     * permissions).
     *
     * @example
     * Permissions A, B and C don't have dependencies. A and B are granted by
     * D. B is granted by E. E and D are granted by F. B.flattened_up()
     * returns [B, D, E, F], not necessarily in that order.
     *
     * @return array<Permission>
     */
    public function flattened_up(): array
    {
        if (count($this->granted_by) === 0) {
            return [$this];
        }

        $permissions = [];

        foreach ($this->granted_by as $granting_permission) {
            $permissions = array_merge($permissions, $granting_permission->flattened_up());
        }

        array_push($permissions, $this);

        return $permissions;
    }

    /**
     * Returns all the subpermissions granted by this one, all the way to the
     * leaves (the ones without any grants for other permissions).
     *
     * @example
     * Permission A grants B and C. Permission B grants D. A.flattened_down()
     * returns [A, B, C, D], not necessarily in that order.
     *
     * @return array<Permission>
     */
    public function flattened_down(): array
    {
        if (count($this->grants) === 0) {
            return [$this];
        }

        $permissions = [];

        foreach ($this->grants as $granted_permission) {
            $permissions = array_merge($permissions, $granted_permission->flattened_down());
        }

        array_push($permissions, $this);

        return $permissions;
    }
}
