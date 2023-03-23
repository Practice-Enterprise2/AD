@extends('layouts.navigation')
<x-app-layout>

    <script type="text/javascript">
        function setLink(elRow) {
        var elLink = document.getElementById('link');
        elLink.href = 'shipments_details/' + elRow.rowIndex;
        }
    </script>

<div class="bg-white h-screen text-center">
<h1 class="text-2xl">Shipment Tracking</h1>
<a id="link">
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
        <tr class="hover:bg-white hover:shadow-lg" onclick="setLink(this);">
            <td class="p-3">{{$shipment->ShipmentName}}</td>
            <td>{{$shipment->ShipmentDate}}</td>
            <td class=
            "@if ($shipment->Name == 'On hold')
                    bg-red
                @elseif ($shipment->Name == 'In progress')
                    bg-orange
                @elseif ($shipment->Name == 'In Transit')
                    bg-yellow
                @elseif ($shipment->Name == 'Delivered')
                    bg-lime
                @elseif ($shipment->Name == 'Completed')
                    bg-green
                @else
                    bg-white
                @endif
            ">{{$shipment->Name}}</td>
        </tr>
       @endforeach
   </tbody>
  </table>
   </a>
</div>
</x-app-layout>