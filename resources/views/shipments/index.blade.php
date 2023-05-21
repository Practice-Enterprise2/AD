{{-- -*-html-*- --}}

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
                Shipment with id: </span>
              <span class="text-black">{{ $shipment->id }}</span>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Shipment status: </span>
              <b class="text-black">{{ $shipment->status }}</b>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-2 inline-block text-lg font-medium text-black underline">
                Shipment Source Address:</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                Street:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->source_address->street }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                House Number:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->source_address->house_number }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                Postal Code:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->source_address->postal_code }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                City:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->source_address->city }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                Region:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->source_address->region }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-4 inline-block text-black">
                Country:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->source_address->country }}</span>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-2 inline-block text-lg font-medium text-black underline">
                Shipment Destination Address:
              </span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                Street:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->destination_address->street }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                House Number:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->destination_address->house_number }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                Postal Code:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->destination_address->postal_code }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                City:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->destination_address->city }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-2 inline-block text-black">
                Region:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->destination_address->region }}</span>
            </p>
            <p class="text-sm text-black">
              <b class="mb-4 inline-block text-black">
                Country:
              </b>
              <span
                class="font-medium text-black">{{ $shipment->destination_address->country }}</span>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Receiver Name:</span>
              <span class="text-black">{{ $shipment->receiver_name }}</span>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Receiver Email:</span>
              <span class="text-black">{{ $shipment->receiver_email }}</span>
            </p>
            <p class="text-sm text-black">
              <span
                class="mb-4 inline-block text-lg font-medium text-black underline">
                Handling Type:</span>
              <span class="text-black">{{ $shipment->type }}</span>
            </p>
            <div class="mb-2 flex justify-end">
              <form action="{{ route('shipments.show', $shipment->id) }}"
                method="GET">
                @csrf
                <button
                  class="me-1 rounded-md bg-green-500 px-4 py-2 text-white hover:bg-green-600"
                  type="submit">
                  Show</button>
              </form>
            </div>
          </div>

        </div>
      @endforeach

    </div>
  </div>

</x-app-layout>
