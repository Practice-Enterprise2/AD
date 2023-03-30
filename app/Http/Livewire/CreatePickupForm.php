<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Pickup;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/*
 * Livewire component form for customers to create a home pickup for their
 * package.
*/
class CreatePickupForm extends Component
{
    public $shipments_without_pending_pickup;

    public Pickup $pickup;

    public Address $address;

    public $date_time;

    protected $rules = [
        'address.street' => 'required|min:1',
        'address.house_number' => 'required|min:1',
        'address.postal_code' => 'required|min:1',
        'address.city' => 'required|min:1',
        'address.region' => 'required|min:1',
        'address.country' => 'required|min:1',
        'pickup.shipment_id' => 'required',
        'date_time' => 'required',
    ];

    public function mount()
    {
        $this->shipments_without_pending_pickup = Shipment::where('user_id', Auth::id())->get();
        $this->pickup = new Pickup();
        $this->address = new Address();
    }

    public function submit()
    {
        $authenticated_user_id = Auth::id();
        $this->validate();
        $this->pickup->time = $this->date_time;
        $this->address->save();
        $this->pickup->address()->associate($this->address);
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
