<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Livewire\Components\CustomerForm;

class CustomerController extends Controller
{
    public function getCustomers()
    {
        $users = User::whereNotIn('id', function ($query) {
                $query->select('user_id')
                      ->from('employees');
            })->get();

        foreach ($users as $user) {
            $address = Address::find($user->address_id);
            $user->address = $address;
        }

        return view('customers', ['users' => $users]);
    }

    public function edit($id)
    {
        $customer = User::find($id);
        $address = Address::find($customer->address_id);

        return view('customers_edit', [
            'customer' => $customer,
            'address' => $address,
            'component' => app()->make(CustomerForm::class, ['id' => $id]),
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = User::find($id);
        $address = Address::find($customer->address_id);

        $customer->name = $request->input('name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');

        $address->street = $request->input('street');
        $address->house_number = $request->input('house_number');
        $address->postal_code = $request->input('postal_code');
        $address->city = $request->input('city');
        $address->region = $request->input('region');
        $address->country = $request->input('country');

        $customer->save();
        $address->save();

        return redirect('/customers');
    }
}
