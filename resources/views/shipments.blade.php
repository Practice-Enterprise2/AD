@extends('layouts.navigation')
<x-app-layout>
<div class="bg-white h-screen justify-center text-center">
<h1 class="text-2xl">Shipment Tracking</h1>
<table class="text-center table-sortable">
    <thead>
        <tr>
            <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="id">ShipmentName</th>
            <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="delDate">DeliveryDate</th>
            <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="status">ShipmentStatus</th>
        </tr>
    </thead>
    <tbody>
      
        @foreach ($shipments as $shipment)
        <tr class="hover:bg-white hover:shadow-lg">
            <td class="p-3">{{$shipment->ShipmentName}}</td>
            <td>{{$shipment->ShipmentDate}}</td>
            <td style="background-color:
            @if ($shipment->Name == 'On hold')
                    red
                @elseif ($shipment->Name == 'In progress')
                    orange
                @elseif ($shipment->Name == 'In Transit')
                    yellow
                @elseif ($shipment->Name == 'Delivered')
                    lime
                @elseif ($shipment->Name == 'Completed')
                    green
                @else
                    white
                @endif
            ">{{$shipment->Name}}</td>
        </tr>
       @endforeach
   </tbody>

  </table>
    </div>
</x-app-layout>