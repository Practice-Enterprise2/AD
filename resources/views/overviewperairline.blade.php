<title>Overview per airline</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}">
<x-app-layout>
  @foreach ($data as $airline)
    @if ($airline->id == $id)
      <table>
        <thead>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
        </thead>
        <tbody>
          <td>{{ $airline->id }}</td>
          <td>{{ $airline->name }}</td>
          <td>{{ $airline->price }}</td>
        </tbody>
      </table>
    @endif
  @endforeach
</x-app-layout>
