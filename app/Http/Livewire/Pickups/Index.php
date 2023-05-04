<?php
/*
Livewire component list to show all the pickups for the logged in user.
*/

namespace App\Http\Livewire\Pickups;

use App\Models\Pickup;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $pickups;

    public function cancel_pickup(int $pickup_id): void
    {
        $pickup = Pickup::query()->find($pickup_id);
        $pickup->status = 'canceled';
        $pickup->save();
        $this->pickups = Pickup::query()->whereHas('shipment', function ($query) {
            return $query->where('user_id', Auth::id());
        })->get();
    }

    public function mount(): void
    {
        $this->pickups = Pickup::query()->whereHas('shipment', function ($query) {
            return $query->where('user_id', Auth::id());
        })->get();
    }

    public function render(): View
    {
        return view('livewire.pickups.index');
    }
}
