@extends('layouts.header')
@section('content')

<br>
<div class="containerForm">
  
  <h1>Edit Depot</h1>

  <form action="{{ url('editDepot/'.$depots->ID)}}" method="POST">
    @csrf
    <input type="text" name="code" placeholder="Depot Code" value="{{ $depots['code'] }}"> <br> <br>
    <input type="text" name="location" placeholder="Depot location" value="{{ $depots['location'] }}"> <br> <br>
    <input type="text" name="size" placeholder="Depot size" value="{{ $depots['size'] }}"> <br> <br>
    <button type="submit">Edit Depot</button>
  </form>

</div>

@endsection