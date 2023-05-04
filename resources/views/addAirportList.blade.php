<h1>Add airport</h1>

<form action="airportList/add" method="POST" autocomplete="off">
   @csrf

  <label for="iata_code">IATA code</label> <br>
  <input type="text" maxlength="3" name="iata_code" required> <br> <br>

  <label for="name">Airport Name</label> <br>
  <input type="text" name="name" required> <br> <br>

  <label for="land">Country</label> <br>
  <input type="text" name="land" required> <br> <br>

  <label for="address_id">Address ID</label> <br>
  <input type="number" maxlength="20" name="address_id" required> <br> <br>

  <button type="submit">Add airport</button>
</form>