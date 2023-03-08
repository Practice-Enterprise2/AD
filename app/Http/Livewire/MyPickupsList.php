<?php

namespace App\Http\Livewire;

use App\Models\Pickup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyPickupsList extends Component
{
    public $pickups;

    public function mount()
    {
        $this->pickups = Pickup::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.my-pickups-list');
    }
}
