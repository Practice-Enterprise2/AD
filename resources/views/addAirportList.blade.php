<h1>Add airport</h1>

<form action="airportList/add" method="POST">
   @csrf

  <label for="iata_code">IATA code</label> <br>
  <input type="iata_code" name="iata_code"> <br> <br>

  <label for="name">Airport Name</label> <br>
  <input type="text" name="name"> <br> <br>

  <label for="land">Country</label> <br>
  <input type="text" name="land"> <br> <br>

  <label for="address_id">Address ID</label> <br>
  <input type="number" name="address_id"> <br> <br>

  <button type="submit">Add airport</button>
</form>