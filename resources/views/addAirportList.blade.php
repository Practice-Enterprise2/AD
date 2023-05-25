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
          <h1 class="font-weight-bold"><b>Add airport</b></h1>
          <form action="airportList/add" method="POST" autocomplete="off">
            @csrf

            <label for="iata_code">IATA code</label> <br>
            <input style="color: black" type="text" maxlength="3" name="iata_code" required> <br>
            <br>

            <label for="name">Airport Name</label> <br>
            <input style="color: black" type="text" name="name" required> <br> <br>

            <label for="land">Country</label> <br>
            <input style="color: black" type="text" name="land" required> <br> <br>

            <label for="address_id">Address ID</label> <br>
            <input style="color: black" type="number" maxlength="20" name="address_id" required> <br>
            <br>

            <button type="submit">Add airport</button>
          </form>
        </div>

    <div>

    </div>
  </div>
</x-app-layout>