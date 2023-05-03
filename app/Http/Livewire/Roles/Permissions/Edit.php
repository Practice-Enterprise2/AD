<?php

namespace App\Http\Livewire\Roles\Permissions;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

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
        $this->emit('role_permission_changed');
        $this->mount();
    }

    public function remove_permission(string $permission_name): void
    {
        $this->role->revokePermissionTo($permission_name);
        $this->emit('role_permission_changed');
        $this->mount();
    }
}
