<?php

namespace App\Http\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;

class Edit extends Component
{
    public Role $role;

    protected $rules = [
        'role.name' => 'required|min:2|max:255',
        'role.description' => 'max:255',
    ];

    public function mount(int $role_id): void
    {
        $this->role = Role::query()->findOrFail($role_id);
    }

    public function save(): void
    {
        $this->validate();

        $this->role->save();
    }
}
