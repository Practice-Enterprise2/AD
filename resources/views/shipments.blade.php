<x-app-layout>
    
<div class="flex justify-center">
    <div class="w-full">
        <h1 class="text-3xl font-semibold mb-4 text-center">Shipment Tracking</h1>

        <div class="overflow-x-auto">
            <table class="table-auto border-collapse border border-gray-400 mx-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">ShipmentName</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">Destination Address</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">ShipmentDate</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">DeliveryDate</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">ShipmentStatus</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(Auth::user()->roles()->first()->name == 'admin' || Auth::user()->roles()->first()->name == 'employee')
                    @foreach($shipments as $shipment)
                    
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100' : '' }}">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->receiver_name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{$shipment->street}} {{$shipment->house_number}}, &nbsp;&nbsp; {{$shipment->city}} {{$shipment->postal_code}} &nbsp;&nbsp;  {{$shipment->country}}  </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->shipment_date }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->delivery_date }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">
                            @if ($shipment->status == 'Exception')
                                <div class="text-base font-bold text-white border-2 bg-gray-500 border-gray-900 rounded-md text-center py-2">Exception</div>                
                            @elseif ($shipment->status == 'Awaiting Confirmation')
                                <div class="text-base font-bold  text-white border-2 bg-orange-500 border-orange-800 rounded-md text-center py-2">Awaiting Confirmation</div>                
                            @elseif ($shipment->status == 'Awaiting Pickup')
                                <div class="text-base font-bold text-white border-2 bg-orange-500 border-orange-800 rounded-md text-center py-2">Awaiting Pickup</div>
                            @elseif ($shipment->status == 'Out For Delivery')
                                <div class="text-base font-bold text-white border-2 bg-blue-500 border-blue-900 rounded-md text-center py-2">Out For Delivery</div>
                            @elseif ($shipment->status == 'In Transit')
                                <div class="text-base font-bold text-white border-2 bg-lime-500 border-lime-900 rounded-md text-center py-2">In Transit</div>
                            @elseif ($shipment->status == 'Delivered')
                                <div class="text-base font-bold text-white border-2 bg-green-500 border-green-900 rounded-md text-center py-2">Delivered</div>
                            @elseif ($shipment->status == 'Held At Location')
                                <div class="text-base font-bold text-white border-2 bg-yellow-500 border-yellow-900 rounded-md text-center py-2">Held At Location</div> 
                            @elseif ($shipment->status == 'Canceled')
                                <div class="text-base font-bold text-white border-2 bg-red-500 border-red-900 rounded-md text-center py-2">Canceled</div>  
                            @endif
                        
                        </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">
{{--                                 <a href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Details</button></a> --}}                              
                                <a href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button type="button" class="rounded-md border-2 border-blue-600 bg-blue-200 px-4 py-2 text-black hover:bg-blue-300">Details</button></a>
                                <a href="#"><button type="button" class="rounded-md border-2 border-red-600 bg-red-200 px-4 py-2 text-black hover:bg-red-300">Cancel</button></a>
                            </td> 
                        </tr>
                    
                    @endforeach
                    @else
                        <!-- Users can only see their own shipment -->
                        <!-- -->
                        @foreach($shipments as $shipment)
                            @if($shipment->user_id == Auth::user()->id)
                            <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100' : '' }}">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->receiver_name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->shipment_date }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->delivery_date }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400
                                @if ($shipment->status == 'Exception')
                                bg-red
                                @elseif ($shipment->status == 'Awaiting Confirmation')
                                    bg-orange
                                @elseif ($shipment->status == 'Awaiting Pickup')
                                    bg-orange
                                @elseif ($shipment->status == 'Out For Delivery')
                                    bg-lightblue
                                @elseif ($shipment->status == 'In Transit')
                                    bg-lime
                                @elseif ($shipment->status == 'Delivered')
                                    bg-green
                                @elseif ($shipment->status == 'Held At Location')
                                    bg-yellow
                                @else
                                    bg-white
                                @endif">{{ $shipment->status }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400"><a href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Details</button></a></td> 
                            </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
        
    </div>
</div>



</x-app-layout>