<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use Livewire\Component;
use Livewire\Redirector;

class Create extends Component
{
    public $role;

    public function mount(): void
    {
        $this->role = new Role();
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'role.name' => 'required|max:255|unique:\App\Models\Role,name',
        'role.description' => 'max:255',
    ];

    public function save(): Redirector
    {
        $this->validate();

        $this->role->save();

        return redirect()->route('control-panel.roles');
    }
}
