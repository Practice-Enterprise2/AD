<?php

namespace App\Http\Livewire\Pickups;

use App\Models\Address;
use App\Models\Pickup;
use App\Models\Shipment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Redirector;

class Create extends Component
{
    // The shipment for which the pickup should be created.
    public int $pickup_shipment_id;

    public $shipments_eligible_for_pickup_creation;

    public string $street;

    public string $region;

    public string $city;

    public string $house_number;

    public string $postal_code;

    public string $country;

    public $time;

    protected $rules = [
        'pickup_shipment_id' => ['required', 'exists:shipments,id'],
        'street' => Address::VALIDATION_RULE_STREET,
        'house_number' => Address::VALIDATION_RULE_HOUSE_NUMBER,
        'postal_code' => Address::VALIDATION_RULE_POSTAL_CODE,
        'city' => Address::VALIDATION_RULE_CITY,
        'region' => Address::VALIDATION_RULE_REGION,
        'country' => Address::VALIDATION_RULE_COUNTRY,
        'time' => Pickup::VALIDATION_RULE_TIME,
    ];

    public function mount(int|null $shipment_id): void
    {
        $this->shipments_eligible_for_pickup_creation = Shipment::query()->whereHas('pickups', function ($query) {
            $query->where('status', '=', 'pending');
        }, '=', 0)->whereHas('pickups', function ($query) {
            $query->where('status', '=', 'completed');
        }, '=', 0)->where('user_id', '=', Auth::id())->get();

        if ($shipment_id != null && Shipment::query()->where('user_id', '=', Auth::id())->find($shipment_id) != null && $this->shipments_eligible_for_pickup_creation->contains('id', '=', $shipment_id)) {
            $this->pickup_shipment_id = $shipment_id;
        }
    }

    /*
     * Validate the form and create the pickup record in the database.
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $pickup_shipment = Shipment::query()->find($this->pickup_shipment_id);

        $pickup_address = Address::query()->firstOrCreate([
            'street' => $this->street,
            'house_number' => $this->house_number,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'region' => $this->region,
            'country' => $this->country,
        ]);

        $pickup = new Pickup([
            'time' => $this->time,
            'status' => 'pending',
        ]);

        $pickup->address()->associate($pickup_address);
        $pickup->shipment()->associate($pickup_shipment);

        $pickup->save();

        return redirect()->to('home');
    }

    public function render(): View
    {
        return view('livewire.pickups.create');
    }
}
