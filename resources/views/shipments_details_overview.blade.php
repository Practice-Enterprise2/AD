@extends('layouts.header')
@section('content')

<table class="text-center">
    <thead>
        <tr>
            <th class="px-6 py-3">Shipment ID</th>
            <th class="px-6 py-3">Shipment Name</th>
            <th class="px-6 py-3">SourceAddress</th>
            <th class="px-6 py-3">DestinationAddress</th>
            <th class="px-6 py-3">Shipment Date</th>
            <th class="px-6 py-3">Delivery Date</th>
            <th class="px-6 py-3">Weigth</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Shipment type</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($shipments as $shipment)
          <tr>
              <td class="p-3">{{$shipment->id}}</td>
              <td>{{$shipment->name}}</td>
              <td>{{$shipment->source_address_id}}</td>
              <td>{{$shipment->destination_address_id}}</td>
              <td>{{$shipment->shipment_date}}</td>
              <td>{{$shipment->delivery_date}}</td>
              <td>{{$shipment->weight}} kg</td>
              <td>{{$shipment->status}}</td>
              <td>{{$shipment->type}}</td>
          </tr>
         @endforeach
   </tbody>
  </table>
</a>
</div>
<div class="text-center pt-6">
    <a href="../shipmentsOverview"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button></a>
</div>
@endsection
