<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use App\Models\Address;
use Livewire\Component;

class CustomerForm extends Component
{
    public $customerId;
    public $name;
    public $lastName;
    public $email;
    public $phone;
    public $street;
    public $houseNumber;
    public $postalCode;
    public $city;
    public $region;
    public $country;

    public function mount($customerId = null)
    {
        $this->customerId = $customerId;
        $this->resetFields();
        if ($this->customerId) {
            $customer = User::find($this->customerId);
            $address = Address::find($customer->address_id);
            $this->name = $customer->name;
            $this->lastName = $customer->last_name;
            $this->email = $customer->email;
            $this->phone = $customer->phone;
            $this->street = $address->street;
            $this->houseNumber = $address->house_number;
            $this->postalCode = $address->postal_code;
            $this->city = $address->city;
            $this->region = $address->region;
            $this->country = $address->country;
        }
    }

    public function render()
    {
        return view('livewire.components.customer-form');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $this->customerId,
            'phone' => 'required|max:255',
            'street' => 'required|max:255',
            'houseNumber' => 'required|max:255',
            'postalCode' => 'required|max:255',
            'city' => 'required|max:255',
            'region' => 'required|max:255',
            'country' => 'required|max:255',
        ]);

        $customer = $this->customerId ? User::find($this->customerId) : new User();
        $customer->name = $this->name;
        $customer->last_name = $this->lastName;
        $customer->email = $this->email;
        $customer->phone = $this->phone;
        $customer->save();

        $address = $customer->address ?: new Address();
        $address->street = $this->street;
        $address->house_number = $this->houseNumber;
        $address->postal_code = $this->postalCode;
        $address->city = $this->city;
        $address->region = $this->region;
        $address->country = $this->country;
        $address->save();

        $customer->address_id = $address->id;
        $customer->save();

        session()->flash('message', $this->customerId ? 'Customer updated successfully.' : 'Customer added successfully.');
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->name = null;
        $this->lastName = null;
        $this->email = null;
        $this->phone = null;
        $this->street = null;
        $this->houseNumber = null;
        $this->postalCode = null;
        $this->city = null;
        $this->region = null;
        $this->country = null;
    }
}
