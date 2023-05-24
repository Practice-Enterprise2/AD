<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}">
<x-app-layout>
  <br>
  <div class="containerForm">

    <h1>Edit Depot</h1>
    @foreach ($depots as $depot)
      <form action="{{ url('editDepotform/' . $depot->id) }}" method="POST">
        @csrf
        
        <label for="code">Code:</label>
        <input type="text" name="code" placeholder="Depot Code"
          value="{{ $depot->code }}"> <br> <br>
        <label for="addressid">Address id:</label>
        <input type="text" name="addressid" placeholder="Depot address"
          value="{{ $depot->address_id }}"> <br> <br>
        <label for="size">Size:</label>
        <input type="text" name="size" placeholder="Depot size"
          value="{{ $depot->size }}"> <br> <br>
        <label for="filled">Space filled:</label>
        <input type="text" name="filled" placeholder="amount filled"
          value="{{ $depot->amountFilled }}"> <br> <br>
        <button type="submit">Edit Depot</button>
      </form>
    @endforeach
  </div>

</x-app-layout>
