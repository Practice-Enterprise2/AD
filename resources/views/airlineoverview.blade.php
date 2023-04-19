<title>Airline Dashboard</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}">
<x-app-layout>
  <div class="wrapper">
    <div>
      <span>Hello <name>{{ $name }}</name></span>
      <p>Last time edited placeholder</p>
    </div>
    <div>
      <table>
        <thead>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Details</th>
        </thead>
        @foreach ($data as $airline)
          <tbody>
            <td>{{ $airline->id }}</td>
            <td>{{ $airline->name }}</td>
            <td>{{ $airline->price }}</td>
            <td><a
                href="{{ url('airlineoverview/' . $airline->id) }}">Details</a>
            </td>
          </tbody>
        @endforeach
      </table>
    </div>
  </div>
</x-app-layout>
