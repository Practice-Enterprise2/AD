<h1>Update airport</h1>

<form action="/editAirport" method="POST" autocomplete="off">
  @csrf
  <input type="hidden" name="id" value="{{ $data['id'] }}" required>

  <label for="iata_code">IATA code</label> <br>
  <input type="text" maxlength="3" name="iata_code"
    value="{{ $data['iata_code'] }}" required> <br> <br>

  <label for="name">Airport Name</label> <br>
  <input type="text" name="name" value="{{ $data['name'] }}" required>
  <br> <br>

  <label for="land">Country</label> <br>
  <input type="text" name="land" value="{{ $data['land'] }}" required>
  <br> <br>

  <label for="address_id">Address ID</label> <br>
  <input type="number" maxlength="20" name="address_id"
    value="{{ $data['address_id'] }}" required> <br> <br>

  <button type="submit">Update</button>
</form>
