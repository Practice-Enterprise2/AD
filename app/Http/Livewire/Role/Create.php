<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Livewire\Redirector;
use Spatie\Permission\Models\Role;

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
        'role.name' => 'required|max:255|unique:\Spatie\Permission\Models\Role,name',
        'role.description' => 'max:255',
    ];

    public function save(): Redirector
    {
        $this->validate();

        $this->role->save();

        return redirect()->route('control-panel.groups');
    }
}
