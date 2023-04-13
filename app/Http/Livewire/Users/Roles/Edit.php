<?php

namespace App\Http\Livewire\Users\Roles;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public User $user;

    public string $role_to_add = '';

    public Collection $unassigned_roles;

    public function mount(): void
    {
        $this->unassigned_roles = Role::query()->whereNotIn('name', $this->user->roles->pluck('name'))->get();
        $this->role_to_add = $this->unassigned_roles->first()->name;
    }

    public function add_role(): void
    {
        $this->user->assignRole($this->role_to_add);
        $this->mount();
    }

    public function remove_role(string $role_name): void
    {
        Log::debug("here with $role_name");
        $this->user->removeRole($role_name);
        $this->mount();
    }
}
