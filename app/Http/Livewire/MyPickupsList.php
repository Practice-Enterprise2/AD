<?php
/*
Livewire component list to show all the pickups for the logged in user.
*/

namespace App\Http\Livewire;

use App\Models\Pickup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyPickupsList extends Component
{
    public $pickups;

    public function cancel_pickup(int $pickup_id)
    {
        $pickup = Pickup::find($pickup_id);
        $pickup->status = 'canceled';
        $pickup->save();
        $this->pickups = Pickup::where('user_id', Auth::id())->get();
    }

    public function mount()
    {
        $this->pickups = Pickup::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.my-pickups-list');
    }
}
