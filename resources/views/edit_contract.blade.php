<x-app-layout>

  <?php




if (!isset($_GET["q"]))
{
    ?>
  <script>
    this.location.replace("/contract?q=1");
  </script>
  <?php
}

?>

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" {{ asset('css/new_contract.css') }}">

    <title>view records</title>

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
    <style>
      /* HEY */
      .x {
        width: 100%;
        border: 1px outset grey;
        margin-bottom: 50px;
      }

      table {
        margin: 0 auto;
        border: 1px solid black;
      }

      .x td {
        margin-left: 10px;
      }

      body {
        background-color: white;
        color: black;
      }

      * {
        color: black;
      }

      @media (min-width: 991.98px) {
        main {
          padding-left: 240px;
        }
      }



      .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 10px;
        width: 70%;
        margin: auto;
      }

      input {
        width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
        border: 1px solid black;
        border-radius: 4px;
        padding: 8px;
        box-sizing: border-box;
      }

    </style>
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
  </head>
  <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
  <script src="{{ asset('js/chosen.jquery.js') }}"></script>
  <script src="{{ asset('js/chosen-initialization.js') }}"></script>

  <main style="margin-top: 58px">
    <div class="container pt-4">
      <div class="container">
      <div class="sidebars">
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
        <form action="edit" method="GET">

          <label for="contNumber">Contract number:</label>
          <input type="number" id="contNumber" name="q"
            autocomplete="off">
          <input type="submit" name="submit">

        </form>

        <?php
        if (isset($_GET["q"]))
        {
            ?>
        @foreach ($contracts as $contract)
          <?php
          $contract = $contracts[0];
          ?>

          <form action="/alter" method="GET">

            <label for="id">Contract ID:</label>
            <input type="number" name="id_s" value="{{ $contract->id }}"
              disabled required>
            <input type="number" name="id" value="{{ $contract->id }}"
              hidden>

            <label>Airline:</label>

            <select class="chosen-select" name="airline">
              @foreach ($airlines as $airline)
                <option <?php
                if ($contracts[0]->airline_id == $airline->id) {
                    echo ' selected '; //twee spaties rondd selected zijn nodig voor het te laten werken
                }
                ?> value="{{ $airline->id }}">
                  {{ $airline->name }}</option>
              @endforeach
            </select>
            <br>
            <label>Start date:</label>
            <input type="date" name="start_date"
              value="{{ $contract->start_date }}" required>

            <label>Expitation Date:</label>
            <input type="date" name="end_date"
              value="{{ $contract->end_date }}" required>

            <label>Price/kg:</label>
            <input type="number" name="price" min="0"
              value="{{ $contract->price }}" required>

            <label for="">Departure Airport:</label>

            <select class="chosen-select" name="departure_location"
              id="departure_airport_select">
              @foreach ($airports as $airport)
                <option <?php
                if ($contracts[0]->depart_airport_id == $airport->id) {
                    echo ' selected ';
                }
                ?> value="{{ $airport->id }}">
                  {{ $airport->name }}</option>
              @endforeach
            </select>
            <br>
            <label for="">Destination Airport:</label>

            <select class="chosen-select" name="destination_location"
              id="destination_airport_select">
              @foreach ($airports as $airport)
                <option <?php
                if ($contracts[0]->destination_airport_id == $airport->id) {
                    echo ' selected ';
                }
                ?>value="{{ $airport->id }}">
                  {{ $airport->name }}</option>
              @endforeach
            </select>

            <input type="submit" name="submit" value="Save Changes">

            <?php

                    if ($contract->is_active == 1)
                    {
                      ?>
            <input style="display:inline;" type="submit" name="deactivate"
              id="deactivate" value="deactivate">

            <?php
                    }
                    else {
                      ?>
            <input style="display:inline;" type="submit" name="reactivate"
              id="reactivate" value="reactivate">
            <?php
                    }

                    ?>
          </form>
        @endforeach
        <?php
        }
        ?>
      </div>
    </div>
  </main>
</x-app-layout>