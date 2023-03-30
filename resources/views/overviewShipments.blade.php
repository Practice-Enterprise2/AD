<<<<<<< HEAD
@extends('layouts.header')
@section('content')
<h1 class="text-3xl font-bold underline text-center break-after-column">Overview shipments</h1>
</div>
<hr>

<div class="text-center justify-center grid">
<div class="grid gap-4 grid-cols-2 grid-rows-1">
  
  <div class="shadow-lg">
     <p class="text-center font-bold">Graphs</p>
     <a href="./graphs"><img class="object-cover h-48 w-96" src="{{url('/images/graphs.png')}}" style="border: 0;"></a>
  </div>

  <div class="shadow-lg"> 
      <p class="text-center font-bold">Shipments</p>
      <a href="./shipmentsOverview"><img class="object-cover h-48 w-96" src="{{url('/images/shipments.jpg')}}" style="border: 0;"></a>
  </div>
</div>
@endsection
=======
<x-app-layout>


<!-- example -->
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
>>>>>>> main
