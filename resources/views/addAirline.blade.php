<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}">
<x-app-layout>

  <div class="containerForm">

    <h1>Add Airline</h1>

    <form action="{{ url('addAirlineform') }}" method="POST">
      @csrf

      <input type="text" name="name" placeholder="Name"> <br> <br>
      <input type="text" name="price" placeholder="Price"> <br>
      <br>
      <button type="submit">Add Airline</button>
    </form>

  </div>

</x-app-layout>
