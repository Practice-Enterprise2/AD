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
  <div class="">
    <!-- Sidebar -->
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
              <input type="text" id="filter" name="filter"
                placeholder="Airport name...">
            </div>
            <button type="submit">Search</button>
          </form>

          <table border="1">
            <thead>
              <th>@sortablelink('id', 'ID')</th>
              <th>@sortablelink('iata_code', 'IATA Code')</th>
              <th>@sortablelink('name', 'Name')</th>
              <th>@sortablelink('land', 'Country')</th>
              <th>@sortablelink('address_id', 'Address ID')</th>
              <th>Actions</th>
            </thead>
            <tbody>

              @if ($airports->count() == 0)
                <tr>
                  <td colspan="5">No airports to display.</td>
                </tr>
              @endif

              @foreach ($airports as $airport)
                @if ($airport['deleted_at'] == null)
                  <tr>
                    <td>{{ $airport['id'] }}</td>
                    <td>{{ $airport['iata_code'] }}</td>
                    <td>{{ $airport['name'] }}</td>
                    <td>{{ $airport['land'] }}</td>
                    <td>{{ $airport['address_id'] }}</td>
                    <td>
                      <a href={{ 'deleteAirport/' . $airport['id'] }}>Remove</a>
                      <a href={{ 'editAirport/' . $airport['id'] }}>Edit</a>
                    </td>
                  </tr>
                @endif
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
            <input type="text" name="iata_code" placeholder="Enter IATA Code">
            <br> <br>
            <input type="text" name="name" placeholder="Enter name">
            <br> <br>
            <input type="text" name="land" placeholder="Enter Country">
            <br> <br>
            <input type="text" name="address_id"
              placeholder="Enter address ID">
            <br> <br>
            <button type="submit">Add airport</button>
          </form>
        </div>
      </div>
    </main>
    <!--Main layout-->
  </div>
@endsection
