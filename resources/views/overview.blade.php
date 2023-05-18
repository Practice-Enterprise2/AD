{{-- -*-html-*- --}}

<x-app-layout>

  {{-- example --}}
  <div style="display:flex; align-items:baseline; width:80%">

    <table>
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Customer ID</th>
          <th>Employee ID</th>
          <th>Issue</th>
          <th>Description</th>
          <th>Solution</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>

        {{-- <a href="{{ route('dump') }}">View Ticket Data Dump</a> --}}
        @foreach ($tickets as $ticket)
          <tr>
            <td>{{ $ticket->ticketID }}</td>
            <td>{{ $ticket->cstID }}</td>
            <td>{{ $ticket->employeeID }}</td>
            <td>{{ $ticket->issue }}</td>
            <td>{{ $ticket->description }}</td>
            <td>{{ $ticket->solution }}</td>
            <td>{{ $ticket->status }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</x-app-layout>
