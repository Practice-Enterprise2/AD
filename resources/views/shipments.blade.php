@extends('layouts.header')
@section('content')

<table class="w-full text-sm text-center">
  <thead>
      <tr>
          <th class="px-6 py-3">Shipment ID</th>
          <th class="px-6 py-3">Shipment Name</th>
          <th class="px-6 py-3">Shipment Date</th>
          <th class="px-6 py-3">Delivery Date</th>
          <th class="px-6 py-3">Weigth</th>
          <th class="px-6 py-3">Status</th>
      </tr>
  </thead>
  <tbody>
       @foreach ($shipments as $shipment)
        <tr>
            <td>{{$shipment->ShipmentID}}</td>
            <td>{{$shipment->ShipmentName}}</td>
            <td>{{$shipment->ShipmentDate}}</td>
            <td>{{$shipment->DeliveryDate}}</td>
            <td>{{$shipment->ShipmentWeight}} kg</td>
            <td>{{$shipment->ShipmentStatus}}</td>
        </tr>
       @endforeach
 </tbody>
</table>
</div>
<div class="text-center pt-6">
    <a href="./shipmentsOverview"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button></a>
</div>
@endsection
