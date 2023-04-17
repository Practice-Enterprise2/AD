<title>Depot Dashboard</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}" >
 <x-app-layout>
<div class="wrapper">
    <div class="child">
        <span >Hello <name>{{$name}}</name></span>
        <p>Last time edited placeholder</p>
    </div>
    <div class="containerMngmt child">
        <a href="/addDepot"><div class="addDiv">
            Add new Depot
        </div></a>
        <div class="legendDiv">
            <div class="legend_name">Depot Code</div>
            <div class="legend_location">Location</div>
            <div class="legend_size">Size</div>
            <div class="legend_filled">amount filled</div>
            <div class="legend_details">Details</div>
        </div>

        <div class="showItemDiv">
            <!-- VB hard coded example-->
            @foreach($depots as $data)
            <div class="airportCard">
                <div class="dataCard">        
                    <div class="name">{{$data->code}}</div>
                    <div class="location">{{$data->address}}</div>
                    <div class="size">{{$data->size}}</div>
                    <div class="size">{{$data->amountFilled}}</div>
                    <div><a href="{{ url('depotoverview/' . $data->id) }}">Details</a></div>
                </div>

                <div class="relButtons">
                    <a href="{{ url('editDepot/'.$data->id) }}"> <div class="editButton"> Edit </div></a>
                    <a href="{{ url('deleteDepot/'.$data->id) }}"> <div class="deleteButton"> Delete </div></a>
                </div>
            </div>
            @endforeach

        
    </div>

</div>
</div>
</x-app-layout>
