<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="{{url('css/airportManagement.css')}}" rel="stylesheet" type="text/css" >


    <title>Airport Management</title>
</head>
<body>

<div class="header">
    <ul>
        <a href="/"><li>Home</li></a>
        <li class="hovor">Management
            <ul class="dropdown">
                <li><a href="/airport-management">Airports</a></li>
                <li><a href="/depot-management">Depots</a></li>
            </ul>
        </li>
    </ul>
</div>


<div class="clear"></div>

<div class="container">
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
                <div class="name">{{$data->Code}}</div>
                <div class="location">{{$data->Location}}</div>
                <div class="size">{{$data->Size}}</div>
            </div>

            <div class="relButtons">
                <a href="{{ url('delete/'.$data->ID) }}"> <div class="deleteButton"> Delete </div></a>
                <div class="editButton"> Edit </div>
                <div class="infoButton"> Info </div>
            </div>
        </div>
        @endforeach

        
    </div>

</div>


</body>
</html>