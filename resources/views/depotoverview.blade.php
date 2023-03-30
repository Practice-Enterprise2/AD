<title>Depot Dashboard</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/airlineoverview.css') }}" >
 <x-app-layout>
<div class="wrapper">
    <div>
        <span >Hello <name>{{$name}}</name></span>
        <p>Last time edited placeholder</p>
    </div>
    <div>
        <table>
            <thead>
                <th>ID</th>
                <th>Code</th>
                <th>Address</th>
                <th>Size</th>
                <th>amountFilled</th>
            </thead>
        @foreach ($data as $depot)
            <tbody>
                <td>{{$depot->id}}</td>
                <td>{{$depot->code}}</td>
                <td>{{$depot->address}}</td>
                <td>{{$depot->size}}</td>
                <td>{{$depot->amountFilled}}</td>
                <td class="clickable"><a href="{{ url('depotoverview/' . $depot->id) }}">Details</a></td>
            </tbody>
        @endforeach
        </table>
    </div>
</div>
</x-app-layout>
