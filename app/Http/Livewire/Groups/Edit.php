<?php

namespace App\Http\Livewire\Groups;

use Livewire\Component;
use Spatie\Permission\Models\Role;

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
