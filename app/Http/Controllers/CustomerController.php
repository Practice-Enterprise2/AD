<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class CustomerController extends Controller
{
    public function getCustomers()
    {
        $users = User::whereNotIn('id', function ($query) {
                $query->select('user_id')
                      ->from('employees');
            })->get();
        return view('customers', ['users' => $users]);
    }
    public function edit($id)
    {
        // Retrieve the customer data from the database
        $customer = User::find($id);

        // Return the edit view with the customer data
        return view('customers_edit', ['customer' => $customer]);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the customer data from the database
        $customer = User::find($id);

        // Update the customer data with the new values
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->role = $request->input('role');
        $customer->save();

        // Redirect to the customer list
        return redirect('/customers');
    }
}