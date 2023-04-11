<x-app-layout>

  <div class="my-4 flex items-center justify-center">
    <div class="mx-auto w-3/5 space-y-6 rounded-md bg-white p-6 shadow-md">
      {{-- Current user --}}
      <h2 class="mb-4 text-sm font-medium text-black">
        Username: {{ auth()->user()->name }}
        Id: {{ auth()->user()->id }}
        Address: {{ auth()->user()->address }}
      </h2>
      <h2 class="mb-4 text-lg font-medium text-black">Evaluate Shipments</h2>

      @foreach ($shipments as $shipment)
        <div class="flex-row rounded-md border border-gray-600 p-4">

          <div>
            <p class="text-sm text-black"><span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment with id: </span> {{ $shipment->id }}</p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Source Address:</span>
              {{ $shipment->source_address }}
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Destination Address:</span>
              {{ $shipment->destination_address }}
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Receiver Name:</span> {{ $shipment->receiver_name }}
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Receiver Email:</span> {{ $shipment->receiver_email }}
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment Handling Type:</span> {{ $shipment->type }}
            </p>
          </div>
          <div>
            <form class="flex justify-end"
              action="{{ route('shipments.requests.evaluate', ['shipment' => $shipment->id]) }}"
              method="POST">
              @csrf
              <div>
                <button
                  class="ml-1 mt-5 rounded-md bg-red-500 px-2 py-0.5 text-xs text-white hover:bg-blue-600"
                  name="decline" type="submit"
                  onclick="return confirm('Are you sure to Decline the Shipment?')">
                  Decline
                </button>
              </div>
              <div>
                <button
                  class="ml-1 rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                  name="set" type="submit">Set</button>
              </div>
            </form>
          </div>
        </div>
      @endforeach

    </div>
  </div>

</x-app-layout>
