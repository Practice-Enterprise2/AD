@extends('layouts.header')
@section('content')
<h1>Customer Details</h1>
    <div>
        <p><strong>Id:</strong> {{ $customer->custID }}</p>
        <p><strong>Name:</strong> {{ $customer->firstname }} {{ $customer->lastname }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        @if ($address)
            <p><strong>Address:</strong> {{ $address->street }} {{ $address->number }}, {{ $address->city }} {{ $address->state }} {{ $address->postal_code }}, {{ $address->country }}</p>
        @else
            <p><strong>Address:</strong> No address found for this customer.</p>
        @endif
        <p><strong>Phone:</strong> {{ $customer->phoneNr }}</p>
        <button onclick="window.location.href='{{ route('customer.edit', $customer->custID) }}'">Edit Customer</button>
       
    </div>
@endsection