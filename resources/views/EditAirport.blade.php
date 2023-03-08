<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{url('css/form.css')}}" rel="stylesheet" type="text/css" >
  <title>Edit Airport</title>
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
  
  <h1>Edit Airport</h1>

  <form action="{{ url('edit/'.$airports->ID)}}" method="POST">
      @csrf
      <input type="text" name="name" value="{{ $airports['name'] }}"> <br> <br>
      <input type="text" name="location"  value="{{ $airports['location'] }}"> <br> <br>
      <input type="text" name="size"  value="{{ $airports['size'] }}"> <br> <br>
      <input type="text" name="owner" value="{{ $airports['owner'] }}"> <br> <br>
      <button type="submit">Edit Airport</button>
  </form>

</div>

</body>
</html>
