@extends('layouts.header')
@section('content')

<div class="containerForm">
  
  <h1>Add Airport</h1>

  <form action="addAirport" method="POST">
    @csrf
    <input type="text" name="iata" placeholder="Airport IATA code"> <br> <br>
    <input type="text" name="name" placeholder="Airport Name"> <br> <br>
    <input type="text" name="size" placeholder="Airport size"> <br> <br>
    <input type="text" name="tracks" placeholder="Airport tracks"> <br> <br>
    <button type="submit">Add Airport</button>
  </form>

</div>

</body>
</html>

@endsection
