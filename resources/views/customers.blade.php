@extends('layouts.header')
@section('content')
<style>
    :root {
        --lgrey: #e0e0e0;
       
        --eLgrey: #f9f9f9;
    }

    h1 {
        text-align: center;
    }

    .tableContainer {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .tableCust {
        border-collapse: collapse;
        width: 80%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: var(--lgrey);
        font-size: 20px;
     
    }

    tr {
        background-color:var(--eLgrey);
    } 
    tr:hover {
    background-color: var(--lgrey);
}
</style>
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