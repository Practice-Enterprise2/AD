@extends('layouts.header')
@section('content')

<div class="clear"></div>

<div class="containerMngmt">
    <a href="/addDepot"><div class="addDiv">
        Add new Depot
    </div></a>
    <div class="legendDiv">
        <div class="legend_name">Depot Code</div>
        <div class="legend_location">Location</div>
        <div class="legend_size">Size</div>
        <div class="legend_buttons">Buttons</div>
    </div>

    <div class="showItemDiv">
        <!-- VB hard coded example-->
        @foreach($depots as $data)
        <div class="airportCard">
            <div class="dataCard">        
                <div class="name">{{$data->code}}</div>
                <div class="location">{{$data->location}}</div>
                <div class="size">{{$data->size}}</div>
            </div>

            <div class="relButtons">
                <a href="{{ url('deleteDepot/'.$data->ID) }}"> <div class="deleteButton"> Delete </div></a>
                <a href="{{ url('editDepot/'.$data->ID) }}"> <div class="editButton"> Edit </div></a>
                <div class="infoButton"> Info </div>
            </div>
        </div>
        @endforeach

        
    </div>

</div>

@endsection