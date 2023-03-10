@extends('layouts.header')
@section('content')
<h1>Customer Overview</h1>
    <div class="tableContainer">
        <table class="tableCust">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>PhoneNR</th>
                
                </tr>
            </thead>
            <tbody>
    @foreach ($customers as $cust)
    <tr onclick="window.location.href='{{ route('customer.show', $cust->custID) }}'">
    
        <td>{{ $cust->custID }}</td>
        <td>{{ $cust->firstname }}</td>
        <td>{{ $cust->lastname }}</td>
        <td>{{ $cust->email }}</td>
        <td>
            @php
                $address = DB::table('addresses')->where('addressID', $cust->addressID)->first();
                if ($address) {
                    echo $address->street . ' ' . $address->number . ', ' . $address->city . ' ' . $address->state . ' ' . $address->postal_code . ', ' . $address->country;
                } else {
                    echo "Address not found";
                }
            @endphp
        </td> 
        <td>{{ $cust->phoneNr }}</td>
       
    </tr>
    @endforeach
</tbody>
        </table>
    </div>
    @endsection    