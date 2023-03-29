<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1"> -->

        <title>Create contract</title>

        <!-- Fonts -->
        <link href="css/new_contract.css" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <h1>Create new contract:</h1>

                <form action="plaats" method="post">
                    @csrf
                    <select>
                        @foreach($data as $row)
                        <option value="{{$row->id}}">{{$row->Airline}}</option>
                        @endforeach
                    </select>

                    <label for="airlineid">AirlineID:</label>
                    <span style="color:red">
                        @error('airlineid')
                        {{$message}}
                        @enderror
                    </span>

                    <input type="text" id="airlineid" name="airlineid" placeholder="AirlineID" >
                    <label for="price">Price:</label>
                    <span style="color:red">
                        @error('price')
                        {{$message}}
                        @enderror
                    </span>
                    <input type="text" id="price" name="price" placeholder="Price" >
                    <label for="creationdate">Creation date:</label>
                    <span style="color:red">
                        @error('creationdate')
                        {{$message}}
                        @enderror
                    </span>
                    <input type="date" id="creationdate" name="creationdate" >
                    <label for="expirationdate">Expiration date:</label>
                    <span style="color:red">
                        @error('expirationdate')
                        {{$message}}
                        @enderror
                    </span>
                    <input type="date" id="expirationdate" name="expirationdate" >
                    <label for="airportid">AirportID</label>
                    <span style="color:red">
                        @error('airportid')
                        {{$message}}
                        @enderror
                    </span>
                    <input type="text" id="airportid" name="airportid" placeholder="AirportID" >
                    <label for="departlocation">Departlocation</label>
                    <span style="color:red">
                        @error('departlocation')
                        {{$message}}
                        @enderror
                    </span>
                    <input type="text" id="departlocation" name="departlocation" placeholder="Departlocation" >
                    <label for="destinationlocation">Destinationlocation</label>
                    <span style="color:red">
                        @error('destinationlocation')
                        {{$message}}
                        @enderror
                    </span>
                    <input type="text" id="destinationlocation" name="destinationlocation" placeholder="Destinationlocation" >
                    <button type="submit">Create</button>
                    <button type="reset">Clear</button>
            </form>
        </div>
    </body>
</html>
