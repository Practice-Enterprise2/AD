<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{url('css/form.css')}}" rel="stylesheet" type="text/css" >
  <title>Edit Depot</title>
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


<br>
<div class="container">
  
  <h1>Edit Depot</h1>

  <form action="{{ url('editDepot/'.$depots->ID)}}" method="POST">
    @csrf
    <input type="text" name="code" placeholder="Depot Code" value="{{ $depots['code'] }}"> <br> <br>
    <input type="text" name="location" placeholder="Depot location" value="{{ $depots['location'] }}"> <br> <br>
    <input type="text" name="size" placeholder="Depot size" value="{{ $depots['size'] }}"> <br> <br>
    <button type="submit">Edit Depot</button>
  </form>

</div>

</body>
</html>
