@extends('layouts.header')
@section('content')
<!-- example -->
<head>
        <title>Create contract</title>
        <!-- Fonts -->
        <link href="css/new_contract.css" rel="stylesheet">

    </head>
<style>
            body {
        background-color: #fbfbfb;
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
            padding: 58px 0 0; /* Height of navbar */
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
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
</style>
<div class="">
<!-- Sidebar -->
<nav
       id="sidebarMenu"
       class=" d-lg-block sidebar bg-white"
       >
       <a href="contractsMenu"><h1><b>Contracts</b></h1></a>
      <div class="list-group list-group-flush mx-3 mt-4">
        <ul>
            <li><a
           href="contract_list"
           class="list-group-item list-group-item-action py-2 ripple "
           >
          <span>contract list</span>
        </a></li>
        <li><a
           href="/new_contract"
           class="list-group-item list-group-item-action py-2 ripple"
           ><span>new contract</span></a
          ></li>

          <li><a
           href="/contract"
           class="list-group-item list-group-item-action py-2 ripple"
           >
          <span>edit contract</span>
        </a></li>
        <li>        <a
           href="airportList"
           class="list-group-item list-group-item-action py-2 ripple"
           ><span>airport list</span></a
          ></li>
        </ul>
    </div>
  </nav>
  <!-- Sidebar -->
  <!--Main layout-->
<main style="margin-top: 58px">
  <div class="container pt-4">
    <div class="">
    <div class="container">
            <h1>Create new contract:</h1>

                <form action="plaats" method="post">
                    @csrf
                    <select>
                        @foreach($data as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
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
    </div>
  </div>
</main>
<!--Main layout-->
</div>
@endsection



