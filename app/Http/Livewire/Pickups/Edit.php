<?php

namespace App\Http\Livewire\Pickups;

use App\Models\Address;
use App\Models\Pickup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class Edit extends Component
{
    // A local copy of the pickup's address.
    public Address $pickup_address;

    public Pickup $pickup;

    public $rules = [
        'pickup_address.street' => Address::VALIDATION_RULE_STREET,
        'pickup_address.house_number' => Address::VALIDATION_RULE_HOUSE_NUMBER,
        'pickup_address.city' => Address::VALIDATION_RULE_CITY,
        'pickup_address.postal_code' => Address::VALIDATION_RULE_POSTAL_CODE,
        'pickup_address.region' => Address::VALIDATION_RULE_REGION,
        'pickup_address.country' => Address::VALIDATION_RULE_COUNTRY,
        'pickup.time' => Pickup::VALIDATION_RULE_TIME,
    ];

    public function mount(int $pickup_id): void
    {
        $pickup = Pickup::query()->find($pickup_id);

        if ($pickup === null) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $this->pickup = $pickup;
        $this->pickup_address = $pickup->address->replicate();
    }

    public function go_back(): Redirector|RedirectResponse
    {
        return back();
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->validate();

        $pickup_address = Address::query()->firstOrCreate([
            'street' => $this->pickup_address->street,
            'house_number' => $this->pickup_address->house_number,
            'city' => $this->pickup_address->city,
            'postal_code' => $this->pickup_address->postal_code,
            'region' => $this->pickup_address->region,
            'country' => $this->pickup_address->country,
        ]);

        $this->pickup->address()->associate($pickup_address);
        $this->pickup->save();

        return redirect()->to('home');
    }
}
