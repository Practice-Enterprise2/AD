@extends('layouts.header')
@section('content')

<div class="containerMngmt">
    <a href="/addAirport"><div class="addDiv">
        Add new Airport
    </div></a>
    <div class="legendDiv">
   
        <div class="legend_name">IATA</div>
        <div class="legend_size">Name</div>
{{--         <div class="legend_location">Location</div> --}}
        <div class="legend_size">Size</div>
        <div class="legend_owner">Tracks</div>
        <div class="legend_buttons">Buttons</div>
    </div>

    <div class="showItemDiv">
        <!-- VB hard coded example-->
        @foreach($airports as $data)
        <div class="airportCard">
            <div class="dataCard">        
                <div class="iata">{{$data->IATA}}</div>
                <div class="name">{{$data->name}}</div>
               {{--  <div class="location">{{$data->location}}</div> --}}
                <div class="size">{{$data->size}}</div>
                <div class="owner">{{$data->tracks}}</div>
            </div>

            <div class="relButtons">
                <a href="{{ url('delete/'.$data->ID) }}"> <div class="deleteButton"> Delete </div></a>
                <a  href="{{ url('edit/'.$data->ID) }}"><div class="editButton"> Edit </div></a>
                <div class="infoButton"> Info </div>
            </div>
        </div>
        @endforeach

        
    </div>

</div>


@endsection