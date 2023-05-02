
@extends('layouts.header')
@section('content')

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
           href="#"
           class="list-group-item list-group-item-action py-2 ripple "
           >
          <span>contract list</span>
        </a></li>
        <li><a
           href="new_contract"
           class="list-group-item list-group-item-action py-2 ripple"
           ><span>new contract</span></a
          ></li>
          <li><a
           href="contract"
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
  <h1 class="font-weight-bold"><b>Contract List</b></h1>

<form action="contract_list" method="GET">
    @csrf
    <div>
      <!-- <p><label for="filter">Search contract id:</label></p> -->
      <p><input type="text" id="filter" name="filter" placeholder="contract id..."></p>
      <!-- <p><label for="filter1">Search by depart location:</label></p>
      <p><input type="text" id="filter1" name="filter1" placeholder="depart location..."></p>
      <p><label for="filter2">Search by destination location:</label></p>
      <p><input type="text" id="filter2" name="filter2" placeholder="destination location..."></p> -->
      <p><label for="active">active contracts:</label></p>
      <p><label for="c_active">active</label><input type="checkbox" id="c_active" name="c_active"><label for="c_inactive">inactive</label><input type="checkbox" id="c_inactive" name="c_inactive"></p>

    </div>
    <button type="submit">Search</button>
</form>
  <table border="1">
    <thead> 
        <th>@sortablelink('contract_id', 'contract_id')</th>
        <th>@sortablelink('airline_id', 'airline_id')</th>
        <th>@sortablelink('start_date', 'start_date')</th>
        <th>@sortablelink('end_date', 'end_date')</th>
        <th>@sortablelink('price', 'price')</th>
        <th>@sortablelink('airport_id', 'airport_id')</th>
        <th>@sortablelink('depart_location', 'depart_location')</th>
        <th>@sortablelink('destination_location', 'destination_location')</th>

    </thead>
    <tbody>

    @foreach ($contracts as $contract)
         <tr>
         <td>{{ $contract->id }}</td>
            <td>{{ $contract->airline_id }}</td>
            <td>{{ $contract->start_date }}</td>
            <td>{{ $contract->end_date }}</td>
            <td>{{ $contract->price }}</td>
            <td>{{ $contract->airport_id }}</td>
            <td>{{ $contract->depart_location }}</td>
            <td>{{ $contract->destination_location }}</td>
            <td><a href="{{Route('contract_pdf', $contract->id)}}">PDF</a></td>

         </tr>
         @endforeach

    </tbody>
</table>
    </div>
  </div>
</main>
<!--Main layout-->
<div>

</div>
</div>
@endsection



    


