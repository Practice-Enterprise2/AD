<x-app-layout>

  <!-- example -->

  <head>
    <title>Create contract</title>
    <!-- Fonts -->
    <link href="css/new_contract.css" rel="stylesheet">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js">
    </script>

    <script>
      $(document).ready(function() {
        $('.chosen-select').chosen();
      });
    </script>
  </head>
  <style>
    body {
      background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
      main {}
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 48px;
      bottom: 0;
      left: 0;
      padding: 58px 0 0;
      /* Height of navbar */
      box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
      width: 240px;
      z-index: 600;
    }

    @media (max-width: 991.98px) {
      .sidebar {
        width: 100%;
      }
    }

    .sidebar .active {
      border-radius: 5px;
      box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: 0.5rem;
      overflow-x: hidden;
      overflow-y: auto;
      /* Scrollable contents if viewport is shorter than content. */
    }

    .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
      width: 50%;
      margin: auto;
    }

    .sidebar-container {
      /* Adjust the following properties as needed */
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      /* Adjust the width as per your design */
      height: 100%;
      z-index: 100;
      /* Make sure the sidebar appears above other elements if necessary */
      /* Add any other required styling */
    }

    input {
      width: 100%;
      margin-top: 10px;
      margin-bottom: 20px;
      border: 1px solid black;
      border-radius: 4px;
      padding: 12px;
      box-sizing: border-box;
    }

    h1 {
      font-weight: bold;
      text-align: center;
      margin-bottom: 50px;
      font-size: 150%;
      text-decoration: underline;
    }
  </style>

  <!-- Sidebar -->
  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">
      <div class="">
        <div class="container">
          <h1>Create new contract:</h1>

          <form action="plaats" method="post">
            @csrf
            <label for="airlineid">AirlineID:</label>
            <hr>
            <select class="chosen-select" name="airlineid" id="airlineid">
              <option value="" selected disabled hidden>select the airline
              </option>
              @foreach ($data as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
              @endforeach
            </select>

            @error('airlineid')
              {{ $message }}
            @enderror

            @error('price')
              {{ $message }}
            @enderror
            </span>
            <hr>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price"
              placeholder="Price">
            <label for="creationdate">Start date:</label>
            <span style="color:red">
              @error('creationdate')
                {{ $message }}
              @enderror
            </span>
            <input type="date" id="creationdate" name="creationdate">
            <label for="expirationdate">End date:</label>
            <span style="color:red">
              @error('expirationdate')
                {{ $message }}
              @enderror
            </span>
            <input type="date" id="expirationdate" name="expirationdate">

            </span>
            @error('departlocation')
              {{ $message }}
            @enderror
            <label for="departlocation">Departlocation:</label>

            <select id="departlocation" name="departlocation"
              class="chosen-select">
              <option value="" selected hidden disabled>Select the
                departlocation
              </option>
              @foreach ($airports as $airport)
                <option value="{{ $airport->id }}">{{ $airport->name }} |
                  {{ $airport->land }}</option>
              @endforeach
            </select>
            @error('destinationlocation')
              {{ $message }}
            @enderror
            <label for="destinationlocation">Destinationlocation:</label>
            <select id="destinationlocation" name="destinationlocation"
              class="chosen-select">
              <option value="" selected hidden disabled>Select the
                destinationlocation
              </option>
              @foreach ($airports as $airport)
                <option value="{{ $airport->id }}">{{ $airport->name }} |
                  {{ $airport->land }}</option>
              @endforeach
            </select>
            <hr>
            <button style="background-color: darkcyan"
              type="submit">Create</button> <br>
            <button style="background-color: orange"
              type="reset">Clear</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!--Main layout-->
  </div>

</x-app-layout>
