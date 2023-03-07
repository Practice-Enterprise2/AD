@extends('layouts.header')
@section('content')
<h1 class="text-center">Details</h1>
<hr>
<table class="table" id="example">
  <thead>
      <tr>
          <th>Shipment ID</th>
          <th>Shipment Date</th>
          <th>Order ID</th>
          <th>Order Weigth</th>
          <th>Destination ID</th>
          <th>Status</th>
      </tr>
  </thead>
  <tbody>
        <tr>
            <td>{{$shipment->shipment_id}}</td>
            <td>{{$shipment->shipment_date}}</td>
            <td>{{$shipment->order_id}}</td>
            <td>{{$shipment->order_weight}} kg</td>
            <td>{{$shipment->destination_id}}</td>
            <td>{{$shipment->status}}</td>
        </tr>
 </tbody>
</table>
@endsection