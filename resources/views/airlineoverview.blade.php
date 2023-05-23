<title>Airline Dashboard</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}">
<x-app-layout>
  <div class="wrapper">
    <div class="child">
      <span>Hello <name>{{ $name }}</name></span>
      @php
        $var = 0;
        if ($airlines != null) {
            foreach ($airlines as $data) {
                if ($data->created_at > $var) {
                    $var = $data->created_at;
                }
                if ($data->updated_at > $var) {
                    $var = $data->updated_at;
                }
                if ($data->deleted_at > $var) {
                    $var = $data - deleted_at;
                }
            }
        }
        
      @endphp
      <p>Last time the table was changed: {{ $var }}</p>
    </div>
    <div class="containerMngmt child">
      <a href="/addAirline">
        <div class="addDiv">
          Add new Airline
        </div>
      </a>
      <div class="legendDiv">
        <div class="legend_name">Name</div>
        <div class="legend_location">Price</div>
        <div class="legend_details">Details</div>
      </div>

      <div class="showItemDiv">
        <!-- VB hard coded example-->
        @foreach ($airlines as $data)
          @if ($data->deleted_at == null)
            <div class="airportCard">
              <div class="dataCard">
                <div class="name">{{ $data->name }}</div>
                <div class="location">{{ $data->price }}</div>
                <div><a
                    href="{{ url('overviewperairline/' . $data->id) }}">Details</a>
                </div>
              </div>

              <div class="relButtons">
                <a href="{{ url('editAirline/' . $data->id) }}">
                  <div class="editButton"> Edit </div>
                </a>
                <a href="{{ url('deleteAirline/' . $data->id) }}">
                  <div class="deleteButton"> Delete </div>
                </a>
              </div>
            </div>
          @endif
        @endforeach

      </div>

    </div>
  </div>
</x-app-layout>
