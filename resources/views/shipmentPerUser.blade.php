<x-app-layout>
<div class="bg-gray-900 py-10">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl font-bold text-white mb-10">Hello {{$username}} These are your shipments </h1>
      <div class="shadow overflow-hidden border-b border-gray-800 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-800">
          <thead class="bg-gray-800">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
{{--               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Source Address</th> --}}
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Destination Address</th> 
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Shipment Date</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Delivery Date</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Buttons</th>
            </tr>
          </thead>
          <tbody class="bg-gray-900 divide-y divide-gray-800">
            @foreach ($shipment as $data)                       
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white"> {{$data->name}} </div>
              </td>

{{--          <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white"> {{ $data->source_address_id}}</div>
              </td>
--}}    
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white"> {{$data->street}} {{$data->house_number}} &nbsp;&nbsp; {{$data->city}} {{$data->postal_code}} &nbsp;&nbsp; {{$data->region}}  {{$data->country}}  </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white">{{$data->shipment_date}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-white">{{$data->delivery_date}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if ($data->status == 0)
                    <div class="text-sm text-white border-2 bg-gray-500 border-gray-900 rounded-md text-center">Package Lost</div>                
                @elseif ($data->status == 1)
                    <div class="text-sm text-white border-2 bg-blue-500 border-blue-700 rounded-md text-center">Awaiting Confirmation</div>               
                @elseif ($data->status == 2)
                    <div class="text-sm text-white border-2 bg-green-500 border-green-700 rounded-md text-center">Order Confirmed</div>       
                @elseif ($data->status == 3)
                    <div class="text-sm text-white border-2 bg-emerald-500 border-emerald-700 rounded-md text-center">In transit</div>     
                @elseif ($data->status == 4)
                    <div class="text-sm text-white border-2 bg-orange-500 border-orange-700 rounded-md text-center">Waiting at pick up point</div>          
                @elseif ($data->status == 5)
                    <div class="text-sm text-white border-2 bg-red-400 border-red-900 rounded-md text-center">Cancelled</div>                
                @endif                               
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <button class="rounded-md border-2 border-red-600 px-3 text-white">Cancel</button>
                <a href="{{ url('shipmentOverview/'.$data->id)}}"><button class="rounded-md border-2 border-blue-600 px-3 text-white">Info</button></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
</x-app-layout>
