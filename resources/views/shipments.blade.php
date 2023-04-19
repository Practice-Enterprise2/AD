
<x-app-layout>
<!-- Include needed for JQ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- using a counter to make unique button id's -->
<script>
   var i = 0; 
</script>

<!-- Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="cancelModal">
  <div class="flex items-center justify-center min-h-screen p-4 text-center">
    <!-- Modal Background -->
    <div class="fixed inset-0 bg-black opacity-75"></div>
    <!-- Modal Content -->
    <div class="bg-white w-full max-w-md mx-auto rounded shadow-lg p-6 relative">
      <h1 class="text-2xl font-bold mb-4">Confirmation</h1>    
      <p class="mb-4">Are you sure you want to cancel the shipment?</p>
      <div class="flex justify-center  bottom-0 w-full pb-6 relative">
        <a href="#"><button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-2" id="confirmCancelButton">
          Yes
        </button></a>
        <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-2" id="cancelCancelButton">
          No
        </button>
      </div>      
    </div>
  </div>
</div>
 
<div class="flex justify-center">
    <div class="w-full">
        <h1 class="text-3xl font-semibold mb-4 text-center">Shipment Tracking</h1>

        <div class="overflow-x-auto">
            <table class="table-auto table-sortable border-collapse border border-gray-400 mx-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400" id="receiver_name">@sortablelink('receiver_name','ShipmentName')</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400" id="shipment_date">@sortablelink('shipment_date','ShipmentDate')</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400" id="delivery_date">@sortablelink('delivery_date','DeliveryDate')</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400" id="status">@sortablelink('status','ShipmentStatus')</th>
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
                                <button class="rounded-md border-2 border-red-600 bg-red-200 px-4 py-2 text-black hover:bg-red-300" id="cancelButton">Cancel</button>

                                <!--  Script that hides / unhides the modal -->
                                    <script>
                                        var button = document.getElementById('cancelButton');                  
                                        button.id = 'cancelButton' + i;
                                        button.dataset.id = i;
                                        cancelButton = button.id;
                                        console.log(cancelButton);
                                        i++;
                                        
                                        var modal = document.getElementById('cancelModal');
                                        var confirmCancelButton = document.getElementById('confirmCancelButton');
                                        var cancelCancelButton = document.getElementById('cancelCancelButton');

                                        button.addEventListener('click', function() {
                                            console.log("Hello, cancel button!");
                                            modal.classList.remove('hidden');
                                        });                   
                                        confirmCancelButton.addEventListener('click', function() {
                                            // Add cancelation code to controller.
                                            var shipmentId = {{ $shipment->id }};
                                            var routeUrl = "{{ route('shipments.cancel', ':id') }}".replace(':id', shipmentId);
                                            modal.classList.add('hidden');
                                            
                                            
                                            window.location.href = routeUrl;
                                        });
                                        cancelCancelButton.addEventListener('click', function() {
                                            modal.classList.add('hidden');
                                        });
                                    </script>
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
                                    {{--<a href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Details</button></a> --}}                              
                                    <a href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button type="button" class="rounded-md border-2 border-blue-600 bg-blue-200 px-4 py-2 text-black hover:bg-blue-300">Details</button></a>
                                    <button class="rounded-md border-2 border-red-600 bg-red-200 px-4 py-2 text-black hover:bg-red-300" id="cancelButton">Cancel</button>


                                </td> 
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