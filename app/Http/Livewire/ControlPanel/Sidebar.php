<?php

namespace App\Http\Livewire\ControlPanel;

use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners = ['role_permission_changed', 'user_role_changed'];

    public function role_permission_changed(): void
    {
    }

    public function user_role_changed(): void
    {
    }
}
