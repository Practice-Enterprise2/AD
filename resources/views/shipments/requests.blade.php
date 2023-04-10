<x-app-layout>

    <div class="flex items-center justify-center my-4">
        <div class="w-3/5 mx-auto bg-white p-6 rounded-md shadow-md space-y-6" >
            {{-- Current user --}}
            <h2 class="text-sm font-medium mb-4 text-black">
                Username: {{ auth()->user()->name }}
                Id: {{ auth()->user()->id }}
                Address: {{ auth()->user()->address }}
            </h2>
            <h2 class="text-lg font-medium mb-4 text-black">Evaluate Shipments</h2>

            @foreach ($shipments as $shipment)
                <div class="flex-row border border-gray-600 rounded-md p-4">

                    <div>
                        <p class="text-sm text-black"><span class="inline-block text-lg underline font-medium mb-4 text-black" > Shipment with id: </span> {{ $shipment->id }}</p>
                        <p class="text-sm text-black">
                            <span class="inline-block text-lg underline font-medium mb-4 text-black" > Shipment Source Address:</span>
                            {{ $shipment->source_address }}
                        </p>
                        <p class="text-sm text-black">
                            <span class="inline-block text-lg underline font-medium mb-4 text-black" > Shipment Destination Address:</span>
                            {{ $shipment->destination_address }}
                        </p>
                        <p class="text-sm text-black">
                            <span class="inline-block text-lg underline font-medium mb-4 text-black" > Shipment Receiver Name:</span>  {{ $shipment->receiver_name }}
                        </p>
                        <p class="text-sm text-black">
                            <span class="inline-block text-lg underline font-medium mb-4 text-black" > Shipment Receiver Email:</span>  {{ $shipment->receiver_email }}
                        </p>
                        <p class="text-sm text-black">
                            <span class="inline-block text-lg underline font-medium mb-4 text-black" > Shipment Handling Type:</span>  {{ $shipment->type }}
                        </p>
                    </div>
                    <div>
                        <form  class="flex justify-end" action="{{ route('shipments.requests.evaluate', ['shipment' => $shipment->id]) }}" method="POST">
                            @csrf
                            <div>
                                <button
                                        class="text-xs bg-red-500 text-white px-2 py-0.5 rounded-md hover:bg-blue-600 ml-1 mt-5" name="decline" type="submit"
                                        onclick="return confirm('Are you sure to Decline the Shipment?')">
                                    Decline
                                </button>
                            </div>
                            <div>
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 ml-1" name="set" type="submit">Set</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
      </div>



    </x-app-layout>
