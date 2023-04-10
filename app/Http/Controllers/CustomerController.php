<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BusinessCustomer;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function getCustomers(): View|Factory
    {
        if ('employee' != Auth::user()->roles()->first()->name) {
            abort(Response::HTTP_FORBIDDEN);
        }


        $users = User::whereNotIn('id', function ($query) {
            $query->select('user_id')
            ->from('employees');
        })
        ->get();


        foreach ($users as $user) {
            $address = Address::find($user->address_id);
            $user->address = $address;


            $business_customer = BusinessCustomer::where('user_id', $user->id)->first();
            if ($business_customer) {
                $user->vat_number = $business_customer->vat_number;
            } else {
                $user->vat_number = null;
            }
        }


        return view('customers', ['users' => $users]);
    }
    
    
    

    /**
     * @param  mixed  $id
     */
    public function edit($id): View|Factory
    {
        $this->authorize('update', User::findOrFail($id));


        $customer = User::whereNotIn('id', function ($query) {
            $query->select('user_id')
            ->from('employees');
        })
        ->where('id', $id)
        ->firstOrFail();


        $address = Address::find($customer->address_id);


        return view('customers_edit', ['customer' => $customer, 'address' => $address]);
    }
    
    


    /**
     * @param  mixed  $id
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $customer = User::find($id);
        $address = Address::find($customer->address_id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'street' => 'required',
            'house_number' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

        return redirect()->route('customer.edit', $id)->with('success', 'Customer updated successfully.');
    }
    $customer = User::find($id);
    $address = Address::find($customer->address_id);

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'last_name' => 'required',
        'phone' => 'required',
        'street' => 'required',
        'house_number' => 'required',
        'postal_code' => 'required',
        'city' => 'required',
        'region' => 'required',
        'country' => 'required',
    ]);


    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }


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


    return redirect()->route('customer.edit', $id)->with('success', 'Customer updated successfully.');
    

}
}

