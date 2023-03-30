@extends('layouts.header')
@section('content')
<!-- example -->
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
       <a href="page2"><h1><b>Contracts</b></h1></a>
      <div class="list-group list-group-flush mx-3 mt-4">
        <ul>
            <li><a
           href=""
           class="list-group-item list-group-item-action py-2 ripple "
           >
          <span>contract list</span>
        </a></li>
        <li><a
           href="/test"
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
        
    <h1>Airports List</h1>

<form action="airportList" method="GET">
    @csrf
    <div>
      <label for="filter">Filter</label>
      <input type="text" id="filter" name="filter" placeholder="Airport name...">
    </div>
    <button type="submit">Search</button>
</form>

<table border="1">
    <thead>
        <th>@sortablelink('name', 'Name')</th>
        <th>@sortablelink('iataCode', 'IATA Code')</th>
        <th>@sortablelink('stateCode', 'State Code')</th>
        <th>@sortablelink('countryCode', 'Country Code')</th>
        <th>@sortablelink('countryName', 'Country Name')</th>
        <th>Actions</th>
    </thead>
    <tbody>
        
        @if ($airports->count() == 0)
            <tr>
                <td colspan="5">No airports to display.</td>
            </tr>
        @endif

        @foreach ($airports as $airport)
            <tr>
                <td>{{ $airport['name'] }}</td>
                <td>{{ $airport['iataCode'] }}</td>
                <td>{{ $airport['stateCode'] }}</td>
                <td>{{ $airport['countryCode'] }}</td>
                <td>{{ $airport['countryName'] }}</td>
                <td>
                    <a href={{ 'deleteAirport/' . $airport['iataCode'] }}>Delete</a>
                    <a href={{ 'editAirport/' . $airport['iataCode'] }}>Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


{{-- Navigation of paginate pages under table  --}}
{!! $airports->appends(Request::except('page'))->render() !!}
{{-- Different way to do the same?
<span>
    {{ $airports->links() }}
</span> --}}


<style>
    .w-5 {
        display: none;
    }
</style>

{{-- Form for adding airports --}}
<h2>Add Airport</h2>

<form action="airportList" method="POST">

    @csrf
    <input type="text" name="airportName" placeholder="Enter name"> <br> <br>
    <input type="text" name="iataCode" placeholder="Enter IATA Code"> <br> <br>
    <input type="text" name="stateCode" placeholder="Enter State Code"> <br> <br>
    <input type="text" name="countryCode" placeholder="Enter Country Code"> <br> <br>
    <input type="text" name="countryName" placeholder="Enter Country Name"> <br> <br>
    {{--  Forms for booleans and integers       
    <label for="usageCheckbox">Airport in use?</label> <br>
    <input type="checkbox" name="usageCheckbox" id="usageCheckbox" value="1"> <br> <br>

    <input type="number" name="tariffAmount" placeholder="Tariff amount"> <br> <br>
--}}
    <button type="submit">Add airport</button>
</form>
    </div>
  </div>
</main>
<!--Main layout-->
</div>
@endsection


