<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;

class Edit extends Component
{
    public $permission;

    protected $rules = [
        'permission.name' => 'required',
        'permission.description' => 'max:255',
    ];

    public function save(): void
    {
        $this->validate();

        $this->permission->save();

        session()->flash('message', 'Permission succesfully updated');
    }
}
