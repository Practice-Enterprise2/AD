<?php

use App\Http\Controllers\contractController;
use App\Http\Controllers\AirportController;


if (!isset($_GET["q"]))
{
    ?>
<script>
  this.location.replace("/contract?q=1");
</script>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">

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
  </style>
  <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
</head>

<body>
 @include('layouts.header')
  <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
  <script src="{{ asset('js/chosen.jquery.js') }}"></script>
  <script src="{{ asset('js/chosen-initialization.js') }}"></script>
  <nav id="sidebarMenu" class="d-lg-block sidebar bg-white">
    <a href="contractsMenu">
      <h1><b>Contracts</b></h1>
    </a>
    <div class="list-group list-group-flush mx-3 mt-4">
      <ul>
        <li><a href="contract_list"
            class="list-group-item list-group-item-action ripple py-2">
            <span>contract list</span>
          </a></li>
        <li><a href="/new_contract"
            class="list-group-item list-group-item-action ripple py-2"><span>new
              contract</span></a></li>

        <li><a href="/contract"
            class="list-group-item list-group-item-action ripple py-2">
            <span>edit contract</span>
          </a></li>
        <li> <a href="airportList"
            class="list-group-item list-group-item-action ripple py-2"><span>airport
              list</span></a></li>
      </ul>
    </div>
  </nav>
  <form action="contract" method="GET" >
    <table>
      <tr>
        <td>Contract number: </td>
        <td><input type="number" id="contNumber" name="q"
            autocomplete="off"></td>
        <td><input type="submit" name="submit"
            ></td>
      </tr>
    </table>
  </form>



      <?php
        if (isset($_GET["q"]))
        {
            ?>
      @foreach ($contracts as $contract)
        <?php
        $contract = $contracts[0];
        ?>

          <form action="/edit" method="GET">
            <table>
              <tr>
                <td>Contract ID:</td>
                <td><input type="number" value="{{ $contract->id }}" disabled
                    required>
                  <input type="number" name="id"
                    value="{{ $contract->id }}" hidden>
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  Airline:

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
                </td>
              </tr>
              <tr>
                <td>Start date:</td>
                <td><input type="date" name="start_date"
                    value="{{ $contract->start_date }}" required></td>
              </tr>
              <tr>
                <td>Expitation Date:</td>
                <td><input type="date" name="end_date"
                    value="{{ $contract->end_date }}" required ></td>
              </tr>
              <tr>
                <td>Price/kg:</td>
                <td><input type="number" name="price" min="0"
                    value="{{ $contract->price }}" required></td>
              </tr>


              <tr>
                <td colspan="2">
                  Departure Airport:

                  <select class="chosen-select" name="departure_location"
                    id="departure_airport_select">
                    @foreach ($airports as $airport)
                      <option <?php
                      if ($contracts[0]->depart_location == $airport->id) {
                          echo ' selected ';
                      }
                      ?> value="{{ $airport->id }}">
                        {{ $airport->name }}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  Destination Airport:
                  <select class="chosen-select" name="destination_location"
                    id="destination_airport_select">
                    @foreach ($airports as $airport)
                      <option <?php
                      if ($contracts[0]->destination_location == $airport->id) {
                          echo ' selected ';
                      }
                      ?>value="{{ $airport->id }}">
                        {{ $airport->name }}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <td><input type="submit" name="submit" value="Save Changes"
                    ></td>
                <td>
                  <?php

                    if ($contract->is_active == 1)
                    {
                      ?>
                        <input type="submit" name="deactivate" id="deactivate" value="deactivate"> </td>
                      <?php
                    }
                    else {
                      ?>
                      <input type="submit" name="reactivate" id="reactivate" value="reactivate"> </td>
                      <?php
                    }

                    ?>

              </tr>
            </table>
          </form>

      @endforeach
      <?php
        }
        ?>


</body>

</html>
