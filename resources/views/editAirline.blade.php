<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}">
<x-app-layout>
  <br>
  <div class="containerForm">

    <h1>Edit Airline</h1>
    @foreach ($airlines as $airline)
      <form action="{{ url('editAirlineform/' . $airline->id) }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="name"
          value="{{ $airline->name }}"> <br> <br>
        <label for="price">Price:</label>
        <input type="text" name="price" placeholder="price"
          value="{{ $airline->price }}"> <br> <br>
        <button type="submit">Edit Airline</button>
      </form>
    @endforeach
  </div>

</x-app-layout>
