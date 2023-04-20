<x-app-layout>
    <div class="container mx-auto mt-4">

        <div class="flex flex-wrap justify-between">
                <div class="bg-darkTheme_gray h-fit rounded-lgs w-full p-6">
                  {{-- Shipment info  --}}
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div class="bg-white rounded-lg shadow-md p-4">
                      <h2 class="text-lg font-medium mb-2">Name Customer</h2>
                      <p class="text-gray-500 font-bold">First And Last Name: <span class="font-thin"> {{$data->name}} </span></p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-4">
                      <h2 class="text-lg font-medium mb-2">Addresses</h2>
                      <p class="text-gray-500 font-bold">Srouce Address: <span class="font-thin"> {{$srcAddress->street}} {{$srcAddress->house_number}} {{$srcAddress->postal_code}} {{$srcAddress->city}} {{$srcAddress->country}} </span></p>
                      <p class="text-gray-500 font-bold">Destination Address: <span class="font-thin"> {{$dstAddress->street}} {{$dstAddress->house_number}} {{$dstAddress->postal_code}} {{$dstAddress->city}} {{$dstAddress->country}} </span></p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-4">
                      <h2 class="text-lg font-medium mb-2">Dates</h2>
                      <p class="text-gray-500 font-bold">Shipment pLacement Date: <span class="font-thin"> {{$data->delivery_date}} </span></p>
                      <p class="text-gray-500 font-bold">Shipment Delivery Date: <span class="font-thin"> {{$data->shipment_date}} </span></p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-4">
                      <h2 class="text-lg font-medium mb-2">Status </h2>
                      <p class="text-gray-500 font-bold">Shipment Status: <span class="font-thin"> {{$data->status}} </span></p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-4">
                      <h2 class="text-lg font-medium mb-2">Time Info</h2>
                      <p class="text-gray-500 font-bold">Created At: <span class="font-thin"> {{$data->created_at}} </span></p>
                      <p class="text-gray-500 font-bold">Updated At: <span class="font-thin"> {{$data->updated_at}} </span></p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-4">
                      <h2 class="text-lg font-medium mb-2">Shipment Info</h2>
                      <p class="text-gray-500 font-bold">Weight: <span class="font-thin"> {{$data->weight}} </span></p>
                      <p class="text-gray-500 font-bold">Expense: <span class="font-thin"> {{$data->expense}} </span></p>
                      <p class="text-gray-500 font-bold">Type: <span class="font-thin"> {{$data->type}} </span></p>
                    </div>
                           
                    </div>
              </div>

              <div class="bg-darkTheme_gray h-fit rounded-lgs w-full p-6 my-4">        
                <div class="flex flex-wrap -mx-4">                  
                  <div class="w-full md:w-2/2 px-4">
                      <div class="bg-white rounded-lg shadow-lg">
                          <div class="px-6 py-4">
                              <div class="font-bold text-xl mb-2">Status of package</div>
                          
                              {{-- Status of the Package delivery process --}}
                              <div class="h-full flex justify-between relative">
                                <div class="h-2.5 rounded-full bg-black dark:border-b-gray-900 absolute bottom-0 left-0 right-0 mb-3"></div> <!-- Gray Line -->
                                
                                @if ($data->status == 0)
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-red-500 dark:bg-red-5S00 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held At Location</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif
                                                                
                                @if ($data->status == 1 || $data->status == 2)
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-orange-500 dark:bg-orange-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held At Location</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif
                                @if ($data->status == 3)
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-yellow-500 dark:bg-yellow-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held At Location</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif
                                                                
                                @if ($data->status == 4)
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-green-500 dark:bg-green-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held At Location</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif

                                @if ($data->status == 5)
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held At Location</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-blue-500 dark:bg-blue-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif                                                            
                              </div>                                                   
                          </div>
                      </div>
                  </div>  

              </div> 
                           
            </div>
            <a href="{{ url('shipmentPerUser') }}"><button class="border-4 border-gray-600 bg-gray-400 p-4 px-14 rounded-lg">Go Back</button></a>
      </div>
</x-app-layout>

    