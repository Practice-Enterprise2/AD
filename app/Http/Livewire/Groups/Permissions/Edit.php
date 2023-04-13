<?php

namespace App\Http\Livewire\Groups\Permissions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public Role $role;

    public string $permission_to_add = '';

    public Collection $unassigned_permissions;

    public function mount(): void
    {
        $this->unassigned_permissions = Permission::query()->whereNotIn('name', $this->role->permissions->pluck('name'))->get();
        $this->permission_to_add = $this->unassigned_permissions->first()->name;
    }

    public function add_permission(): void
    {
        $this->role->givePermissionTo($this->permission_to_add);
        $this->mount();
    }

    public function remove_permission(string $permission_name): void
    {
        Log::debug("here with $permission_name");
        $this->role->revokePermissionTo($permission_name);
        $this->mount();
    }
}
