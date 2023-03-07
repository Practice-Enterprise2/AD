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
@endsection
