<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Username extends Component
{
    protected $listeners = ['username_changed'];

    public function username_changed(): void
    {
    }
}
