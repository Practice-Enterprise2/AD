<x-app-layout>

    <div class="flex items-center justify-center my-4">
        <div class="w-3/5 mx-auto bg-white p-6 rounded-md shadow-md space-y-6" >
            {{-- Current user --}}
            <h2 class="text-sm font-medium mb-4">
                Username: {{ auth()->user()->name }}
                Id: {{ auth()->user()->id }}
                Address: {{ auth()->user()->address }}
            </h2>
            <h2 class="text-lg font-medium mb-4">Show Confirmed Shipments</h2>

            @foreach ($shipments as $shipment)
                <div class="flex flex-col border border-gray-600 rounded-md p-4">

                    <div>
                        <p class="text-sm"><span class="inline-block text-lg underline font-medium mb-4" > Shipment with id: </span> <b>{{ $shipment->id }}</b></p>
                        <p class="text-sm"><span class="inline-block text-lg underline font-medium mb-4" > Shipment status: </span> <b>{{ $shipment->status }}</b></p>
                        <p class="text-sm">
                            <span class="inline-block text-lg underline font-medium mb-4" > Shipment Source Address:</span>  <b>{{ $shipment->source_address }}</b>
                        </p>
                        <p class="text-sm">
                            <span class="inline-block text-lg underline font-medium mb-4" > Shipment Destination Address:</span>  <b>{{ $shipment->destination_address }}</b>
                        </p>
                        <p class="text-sm">
                            <span class="inline-block text-lg underline font-medium mb-4" > Shipment Receiver Name:</span>  <b>{{ $shipment->receiver_name }}</b>
                        </p>
                        <p class="text-sm">
                            <span class="inline-block text-lg underline font-medium mb-4" > Shipment Receiver Email:</span>  <b>{{ $shipment->receiver_email }}</b>
                        </p>
                        <p class="text-sm">
                            <span class="inline-block text-lg underline font-medium mb-4" > Shipment Handling Type:</span>  <b>{{ $shipment->handling_type }}</b>
                        </p>

                        <div class="px-2 space-y-2">
                            <hr class="border border-gray-500 my-4">
                            @foreach ($shipment->waypoints as $waypoint)
                                <div>
                                    <p>Waypoint State: <b>{{ $waypoint->state }}</b></p>
                                    <p>Waypoint Current Address: <b>{{ $waypoint->current_address }}</b></p>
                                    <p>Waypoint Next Address: <b>{{ $waypoint->next_address }}</b></p>
                                    <hr class="border border-gray-500 my-4">
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
