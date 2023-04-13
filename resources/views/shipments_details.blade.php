<x-app-layout>

    
    @foreach($shipments as $shipment)
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white h-screen">
        <h1 class="text-2xl font-semibold mb-4">{{ __('Shipment Tracking') }}</h1>
        <div class="flex justify-between mb-8">
          <div>
            <p class="text-sm font-medium text-gray-500">{{ __('Shipment Date') }}</p>
            <p class="text-lg font-semibold">{{ $shipment->shipment_date }}</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">{{ __('Estimated Delivery') }}</p>
            <p class="text-lg font-semibold">{{ $shipment->delivery_date }}</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">{{ __('Shipment Weight') }}</p>
            <p class="text-lg font-semibold">{{ $shipment->weight }} kg</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">{{ __('Status') }}</p>
            <p class="text-lg font-semibold {{ $shipment->status === 'Delivered' ? 'text-green-600' : 'text-orange-600' }}">{{ $shipment->status }}</p>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
          <div class="px-6 py-4">
            <h2 class="text-xl font-semibold mb-4">{{ __('Sender Information') }}</h2>
            <p class="text-gray-700 mb-2"><span class="font-medium">{{ __('Name') }}:</span> {{ $shipment->receiver_name }}</p>
          </div>
        </div>
        <div class="text-center pt-6 bg-white">
        <a href="../shipments"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button></a>
    </div>
    </div>
    
    @endforeach
   
</x-app-layout>