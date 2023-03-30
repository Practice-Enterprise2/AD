@extends('layouts.header')
@section('content')

<script type="text/javascript">
    function setLink(elRow) {
    var elLink = document.getElementById('link');
    elLink.href = 'shipments_details_overview/' + elRow.rowIndex;
    }


</script>
<script src="tablesort.min.js">
    document.querySelector('.table-sortable').tsortable()
</script>
<?php

  
  /*$query = $con->query("
  SELECT ShipmentID, ShipmentName, ShipmentDate, DeliveryDate, ShipmentWeight, ShipmentStatus FROM shipments
     ORDER BY ShipmentID ASC;
  ");*/


?>

<a id="link">
<table class="text-center table-sortable">
  <thead>
      <tr>
          <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="id">@sortablelink('id', 'Shipment ID')</th>
          <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="name">@sortablelink('name', 'Shipment Name')</th>
          <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="shipDate">@sortablelink('shipment_date', 'Shipment Date')</th>
          <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="delDate">@sortablelink('delivery_date', 'Delivery Date')</th>
          <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="weight">@sortablelink('weight', 'Shipment Weight')</th>
          <th class="px-6 py-3 hover:bg-white hover:shadow-lg data-sort" id="status">@sortablelink('status', 'Shipment Status')</th>
      </tr>
  </thead>
  <tbody>
    
       @foreach ($shipments as $shipment)
        <tr class="hover:bg-white hover:shadow-lg" onclick="setLink(this);">
            <td class="p-3">{{$shipment->id}}</td>
            <td>{{$shipment->name}}</td>
            <td>{{$shipment->shipment_date}}</td>
            <td>{{$shipment->delivery_date}}</td>
            <td>{{$shipment->weight}} kg</td>
            <td>{{$shipment->status}}</td>
        </tr>
       @endforeach
 </tbody>
</table>
{{-- Navigation of paginate pages under table  --}}
{!! $shipments->appends(Request::except('page'))->render() !!}
{{-- Different way to do the same?
    <span>
        {{ $airports->links() }}
    </span> --}}
</a>
</div>




<div class="text-center pt-6">
    <a href="./shipmentsMenu"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button></a>
</div>
<!--
<div class="flex items-center justify-end mt-4">
    <p class="font-medium">
      Filters
    </p>

  <div>
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 mt-4">
      <select class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm" name="filter[]">
        <option value="all">All Type</option>
        <option value="hold">On hold</option>
        <option value="progress">In progress</option>
        <option value="transit">In transit</option>
        <option value="delivered">Delivered</option>
        <option value="completed">Completed</option>
      </select>
      <button type="button" name="filteren" id="filteren" onclick="filter()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">filter</button></a>
    </div>
</div> 
-->
@endsection
