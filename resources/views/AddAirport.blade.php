<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{url('css/form.css')}}" rel="stylesheet" type="text/css" >
  <title>Document</title>
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
  
  <h1>Add Airport</h1>

  <form action="addAirport" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Airport Name"> <br> <br>
    <input type="text" name="location" placeholder="Airport location"> <br> <br>
    <input type="text" name="size" placeholder="Airport size"> <br> <br>
    <input type="text" name="owner" placeholder="Airport owner"> <br> <br>
    <button type="submit">Add Airport</button>
  </form>

</div>

</body>
</html>
