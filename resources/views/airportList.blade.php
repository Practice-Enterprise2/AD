<x-app-layout>
  <style>
    body {
      background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
      main {
        padding-left: 240px;
      }
    }

    form,
    h1 {
      margin-left: 400px;
    }

    table {}

    th {
      margin: 20px;
    }

    td {
      padding: 20px;
    }

    tr:nth-child(2n) {
      background-color: lightgrey;
    }
    .nav-item{
      margin: 10px;
    }
   .sidebar{
    position: relative;
    float: left;
    margin-right: 20px;
   }
  </style>
  <div class="">
    <main style="margin-top: 20px">
    <div class="sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('airportList') }}">
                        -Airport List
                    </a>
                </li>
                <li class="nav-item">
                  <a href={{ 'addAirportList' }}>
                    -Add Airport
                  </a>
                </li>
            </ul>
        </div>
    </div>
  <div class="">
    <!--Main layout-->
    {{-- <main style="margin-top: 58px">
      <div class="container pt-4"> --}}
        <div class="">

          <h1 class="font-weight-bold"><b>Airport List</b></h1>

          <form action="airportList" method="GET">
            @csrf
            <div>
              <p><label for="filter">Search airport:</label></p>
              <input style="color: black" type="text" id="filter" name="filter"
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


        </div>
      </div>
    </main>
    <!--Main layout-->
  </div>
</x-app-layout>