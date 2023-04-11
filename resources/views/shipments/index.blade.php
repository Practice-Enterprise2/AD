<x-app-layout>

  <div class="my-4 flex items-center justify-center">
    <div class="mx-auto w-3/5 space-y-6 rounded-md bg-white p-6 shadow-md">
      {{-- Current user --}}
      <h2 class="mb-4 text-sm font-medium text-black">
        Username: {{ auth()->user()->name }}
        Id: {{ auth()->user()->id }}
        Address: {{ auth()->user()->address }}
      </h2>
      <h2 class="mb-4 text-lg font-medium text-black">Show Confirmed Shipments
      </h2>

      @foreach ($shipments as $shipment)
        <div class="flex flex-col rounded-md border border-gray-600 p-4">

          <div>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment with id: </span> <b
                class="text-black">{{ $shipment->id }}</b>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment status: </span> <b
                class="text-black">{{ $shipment->status }}</b>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Source Address:</span> <b
                class="text-black">{{ $shipment->source_address }}</b>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Destination Address:</span> <b
                class="text-black">{{ $shipment->destination_address }}</b>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Receiver Name:</span> <b
                class="text-black">{{ $shipment->receiver_name }}</b>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Receiver Email:</span> <b
                class="text-black">{{ $shipment->receiver_email }}</b>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Handling Type:</span> <b
                class="text-black">{{ $shipment->type }}</b>
            </p>

            <div class="space-y-2 px-2">
              <hr class="my-4 border border-gray-500">
              @foreach ($shipment->waypoints as $waypoint)
                <div>
                  <p class="text-black">Waypoint State: <b
                      class="text-black">{{ $waypoint->status }}</b></p>
                  <p class="text-black">Waypoint Current Address: <b
                      class="text-black">{{ $waypoint->current_address }}</b>
                  </p>
                  <p class="text-black">Waypoint Next Address: <b
                      class="text-black">{{ $waypoint->next_address }}</b></p>
                  <hr class="my-4 border border-gray-500">
                </div>
              @endforeach
            </div>
            <div class="flex justify-end border p-2">
              {{ QrCode::size(200)->generate(route('shipments.update-waypoint', ['shipment' => $shipment->id])) }}
            </div>
          </div>

        </div>
      @endforeach

    </div>
  </div>

</x-app-layout>
