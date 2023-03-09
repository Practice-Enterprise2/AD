<?php

namespace App\Http\Livewire;

use App\Models\Pickup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/*
 * Livewire component form for customers to create a home pickup for their
 * package.
*/
class CreatePickupForm extends Component
{
    public Pickup $pickup;
    public $date_time;

    protected $rules = [
        'pickup.street' => 'required|min:1',
        'pickup.house_number' => 'required|min:1',
        'pickup.postal_code' => 'required|min:1',
        'pickup.city' => 'required|min:1',
        'pickup.region' => 'required|min:1',
        'pickup.country' => 'required|min:1',
        'date_time' => 'required',
    ];

    public function mount()
    {
        $this->pickup = new Pickup();
    }

    public function submit()
    {
        $authenticated_user_id = Auth::id();
        $this->validate();
        $this->pickup->time = $this->date_time;
        $this->pickup->user_id = $authenticated_user_id;
        $this->pickup->save();
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.create-pickup-form');
    }

    public function __toString()
    {
        return "Pickup: $this->pickup\nDate: $this->date";
    }
}
