@extends('layouts.header')
@section('content')

<div class="containerForm">
  
  <h1>Add Depot</h1>

  <form action="addDepot" method="POST">
    @csrf
    <input type="text" name="code" placeholder="Depot Code"> <br> <br>
    <input type="text" name="location" placeholder="Depot location"> <br> <br>
    <input type="text" name="size" placeholder="Depot size"> <br> <br>
    <button type="submit">Add Depot</button>
  </form>

</div>

@endsection
