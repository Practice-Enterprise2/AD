<x-app-layout>

  <!-- example -->

  <head>
    <title>Create contract</title>
    <!-- Fonts -->
    <link href="css/new_contract.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

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

    .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
      width: 50%;
      margin: auto;
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

    .sidebar {
      margin-bottom: 50px;
    }

    .error-message {
      color: red;
    }
  </style>

  <!-- Sidebar -->
  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">
      <div class="">
        <div class="container">
          <div class="sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('contract_list') }}">
                    -Contract List
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('new_contract') }}">
                    -New Contract
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('edit_contract') }}">
                    -Edit Contract
                  </a>
                </li>
              </ul>
            </div>
            <h1>Create new contract:</h1>

            <form action="plaats" method="post">
              @csrf
              <label for="airlineid">AirlineID:</label>
              <span class="error-message">
                @error('airlineid')
                  {{ $message }}
                @enderror
              </span>
              <hr>
              <select class="chosen-select" name="airlineid" id="airlineid">
                <option value="" selected disabled hidden>select the airline</option>
                @foreach ($data as $row)
                  <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
              </select>
              <hr>
              <label for="price">Price:</label>
              <span class="error-message">
                @error('price')
                  {{ $message }}
                @enderror
              </span>
              <input type="text" id="price" name="price" placeholder="Price">

              <label for="creationdate">Start date:</label>
              <span class="error-message">
                @error('creationdate')
                  {{ $message }}
                @enderror
              </span>
              <input type="date" id="creationdate" name="creationdate">

              <label for="expirationdate">End date:</label>
              <span class="error-message">
                @error('expirationdate')
                  {{ $message }}
                @enderror
              </span>
              <input type="date" id="expirationdate" name="expirationdate">
              <label for="departlocation">Departlocation:</label>
              <span class="error-message">
                @error('departlocation')
                  {{ $message }}
                @enderror
              </span>
              <hr>
              <select id="departlocation" name="departlocation" class="chosen-select">
                <option value="" selected hidden disabled>Select the departlocation</option>
                @foreach ($airports as $airport)
                  <option value="{{ $airport->id }}">{{ $airport->name }} | {{ $airport->land }}</option>
                @endforeach
              </select>
              <label for="destinationlocation">Destinationlocation:</label>
              <span class="error-message">
                @error('destinationlocation')
                  {{ $message }}
                @enderror
              </span>
              <hr>
              <select id="destinationlocation" name="destinationlocation" class="chosen-select">
                <option value="" selected hidden disabled>Select the destinationlocation</option>
                @foreach ($airports as $airport)
                  <option value="{{ $airport->id }}">{{ $airport->name }} | {{ $airport->land }}</option>
                @endforeach
              </select>
              <hr>
              <button style="background-color: darkcyan" type="submit">Create</button> <br>
              <button style="background-color: orange" type="reset">Clear</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--Main layout-->
</x-app-layout>
