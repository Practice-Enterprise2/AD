<x-app-layout>
    
<div class="flex justify-center">
    <div class="w-full max-w-4xl">
        <h1 class="text-3xl font-semibold mb-4 text-center">Shipment Tracking</h1>

        <div class="overflow-x-auto">
            <a id="link">
            <table class="table-auto w-full border-collapse border border-gray-400">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">ShipmentName</th>
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
                                bg-yellow
                            @elseif ($shipment->status == 'Delivered')
                                bg-green
                            @elseif ($shipment->status == 'Held At Location')
                                bg-lime
                            @else
                                bg-white
                            @endif">{{ $shipment->status }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400"><a href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Details</button></a></td> 
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
                                    bg-yellow
                                @elseif ($shipment->status == 'Delivered')
                                    bg-green
                                @elseif ($shipment->status == 'Held At Location')
                                    bg-lime
                                @else
                                    bg-white
                                @endif">{{ $shipment->status }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400"><a href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Details</button></a></td> 
                            </tr>
                            @endif
                        @endforeach
                    @endif
                    </a>
                </tbody>
            </table>
        </div>
        
        
    </div>
</div>



</x-app-layout>