<h1>Update airport</h1>

<form action="/editAirport" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] }}">

    <label for="iata_code">Airport Name</label> <br>
    <input type="iata_code" name="iata_code" value="{{ $data['iata_code'] }}"> <br> <br>

    <label for="name">Airport Name</label> <br>
    <input type="text" name="name" value="{{ $data['name'] }}"> <br> <br>
    
    <label for="land">Country</label> <br>
    <input type="text" name="land" value="{{ $data['land'] }}"> <br> <br>

    <label for="address_id">Address ID</label> <br>
    <input type="number" name="address_id" value="{{ $data['address_id'] }}"> <br> <br>

    <button type="submit">Update</button>
</form>