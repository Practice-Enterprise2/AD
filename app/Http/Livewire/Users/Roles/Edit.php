<?php

namespace App\Http\Livewire\Users\Roles;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

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
        $this->emit('user_role_changed');
        $this->mount();
    }

    public function remove_role(string $role_name): void
    {
        $this->user->removeRole($role_name);
        $this->emit('user_role_changed');
        $this->mount();
    }
}
