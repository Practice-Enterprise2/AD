@extends('layouts.header')
@section('content')

<div class="containerForm">
  
  <h1>Edit Airport</h1>

  <form action="{{ url('edit/'.$airports->ID)}}" method="POST">
      @csrf
      <input type="text" name="iata" value="{{ $airports['IATA'] }}"> <br> <br>
      <input type="text" name="name"  value="{{ $airports['name'] }}"> <br> <br>
      <input type="text" name="size"  value="{{ $airports['size'] }}"> <br> <br>
      <input type="text" name="tracks" value="{{ $airports['tracks'] }}"> <br> <br>
      <button type="submit">Edit Airport</button>
  </form>

</div>

@endsection