@extends('layouts.header')
@section('content')
<h1>Edit Customer</h1>
    <form action="{{ route('customer.update', $customer->custID) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="{{ $customer->firstname ?? 'Value not found' }}" required><br>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="{{ $customer->lastname ?? 'Value not found' }}" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $customer->email ?? 'Value not found' }}" required><br>

        <label for="phoneNr">Phone Number:</label>
        <input type="text" id="phoneNr" name="phoneNr" value="{{ $customer->phoneNr ?? 'Value not found' }}" required><br>

        <label for="street">Street:</label>
        <input type="text" id="street" name="street" value="{{ $address->street ?? 'Value not found' }}" required><br>

        <label for="number">Number:</label>
        <input type="text" id="number" name="number" value="{{ $address->number ?? 'Value not found' }}" required><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="{{ $address->city ?? 'Value not found' }}" required><br>

        <label for="state">state:</label>
        <input type="text" id="state" name="state" value="{{ $address->state ?? 'Value not found' }}" required><br>

        <label for="postal_code">postal_code:</label>
        <input type="postal_code" id="postal_code" name="postal_code" value="{{ $address->postal_code ?? 'Value not found' }}" required><br>

        <label for="country">country:</label>
        <input type="country" id="country" name="country" value="{{ $address->country ?? 'Value not found' }}" required><br>

        <button type="submit">Save Changes</button>
    </form>
    @endsection