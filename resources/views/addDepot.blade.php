<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}">
<x-app-layout>

  <div class="containerForm">

    <h1>Add Depot</h1>

    <form action="{{ url('addDepotform') }}" method="POST">
      @csrf

      <input type="text" name="street" placeholder="Street name"> <br> <br>
      <input type="text" name="house_number" placeholder="House number"> <br>
      <br>
      <input type="text" name="postal_code" placeholder="Postal code"> <br>
      <br>
      <input type="text" name="city" placeholder="City"> <br> <br>
      <input type="text" name="region" placeholder="Region"> <br> <br>
      <input type="text" name="country" placeholder="Country"> <br> <br>
      <input type="text" name="code" placeholder="Depot Code"> <br> <br>
      <input type="text" name="size" placeholder="Depot size"> <br> <br>
      <input type="text" name="filled" placeholder="amount filled"> <br>
      <br>
      <button type="submit">Add Depot</button>
    </form>

  </div>

</x-app-layout>
