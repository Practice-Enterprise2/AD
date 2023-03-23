<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--     @vite('{{url('resources/css/app.css')}}') --}}

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Home</title>
    <link href="{{url('css/home.css')}}" rel="stylesheet" type="text/css" > 
    <link href="{{url('css/form.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{url('css/shipments.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{url('css/airportManagement.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{url('css/addForm.css')}}" rel="stylesheet" type="text/css" >

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
        <li><a href="/shipments">Shipments</a></li>
    </ul>
</div>

<br>

@yield('content')

</body>
</html>