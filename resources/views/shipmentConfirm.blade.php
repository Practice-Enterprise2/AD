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
    </div>
</x-app-layout>

    