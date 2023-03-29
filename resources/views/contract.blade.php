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
    <link rel="stylesheet" href="">
    <title>view records</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js">

</script>
<script>
    $(document).ready(function() {
      $('.chosen-select').chosen();
    });
    </script>
    <style>

.x
{

    width: 100%;
    border: 1px outset grey;
    margin-bottom: 50px;
}
table
{
        margin: 0 auto;
        border: 1px solid black;
}
.x td
{
    margin-left: 10px;
}
    </style>
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('js/chosen.jquery.js') }}"></script>
<script src="{{asset('js/chosen-initialization.js')}}"></script>
    <form action="contract" method="GET">
    <table>
    <tr>
        <td>Contract number: </td>
        <td><input type="number" id="contNumber" name="q" autocomplete="off"></td>
        <td><input type="submit" name="submit"></td>
    </tr>
</table>
    </form>


    <table>
        <tr>

        <?php
        if (isset($_GET["q"]))
        {
            ?>
            @foreach ($contracts as $contract)
            <td>

                <form action="/edit" method="GET">
                    <table>
                        <tr>
                        <td>Contract ID:</td> <td><input type="number"  value="{{ $contract->id }}" disabled required>
                        <input type="number" name="id" value="{{ $contract->id }}" hidden></td>
                        </tr>
                        <tr>
                            <td>Airline name:</td> <td><input type="text"  value="{{ $contract->Airline }}"  required disabled>
                            <input type="number"  value="{{ $contract->airline_id }}" name="airline"  hidden></td>
                        </tr>
                        <tr>
                            <td>Start date:</td>
                            <td><input type="date" name="start_date" value="{{ $contract->start_date }}" required></td>
                        </tr>
                        <tr>
                            <td>End date:</td>
                            <td><input type="date" name="end_date" value="{{ $contract->end_date }}" required></td>
                        </tr>
                        <tr>
                            <td>Price/kg:</td> <td><input type="number" name="price" value="{{ $contract->price }}" required></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                airport:

                                <select class="chosen-select" name="airportID">
                                    @foreach ($airports as $airport )
                                    <option <?php
                                        if ($contracts[0]->depart_location == $airport->id)
                                        {
                                            echo " selected ";
                                        }
                                    ?> value="{{ $airport->id }}"> {{$airport->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                          </tr>
                     <!--   <tr>
                            <td>Departure airport:</td> <td><input type="text" name="departure_airport" value="{{ $contract->depart_airport }}" required></td>
                      </tr>
                    -->
                     <!--   <tr>
                            <td>Destination airport:</td> <td><input type="text" name="destination_airport" value="{{ $contract->destination_airport }}" required></td>
                        </tr>
                    -->

                    <tr>
                        <td colspan="2">
                            Departure location:

                            <select class="chosen-select" name="departure_location" id="departure_airport_select">
                                @foreach ($airports as $airport )
                                <option <?php
                                    if ($contracts[0]->depart_location == $airport->id)
                                    {
                                        echo " selected ";
                                    }
                                ?> value="{{ $airport->id }}"> {{$airport->name}}</option>
                                @endforeach
                            </select>
                        </td>
                      </tr>
                    <tr>
                        <td colspan="2">
                            Destination location:
                            <select  class="chosen-select" name="destination_location" id="destination_airport_select">
                                @foreach ($airports as $airport )
                                <option <?php
                                    if ($contracts[0]->destination_location  == $airport->id)
                                    {
                                        echo " selected ";
                                    }
                                ?>value="{{ $airport->id }}"> {{$airport->name}}</option>
                                @endforeach
                            </select>
                        </td>
                      </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="Save Changes"></td> <td><?php
                              /*  if ($contracts[0]->active == 1)
                                {
                                    ?>
                                    <input type="submit" name="remove" value="delete contract">
                                    <?php
                                }
                                else {
                                    ?>
                                     <input type="submit" name="reactivate" value="reactivate contract">
                                    <?php
                                } */

                                ?>  reactivate/delete currently broken due to current database structure</td>
                        </tr>
                    </table>
                </form>
            </td>
            @endforeach
            <?php
        }
        ?>
        </tr>

    </table>


</body>
</html>
