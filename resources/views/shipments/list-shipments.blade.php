{{-- -*-html-*- --}}

<x-app-layout>
  <div class="my-4 flex items-center justify-center">
    <div class="mx-auto w-3/5 space-y-6 rounded-md bg-white p-6 shadow-md">
      <div class="space-y-2">
        <h1 class="bold text-xl text-black">Shipment's of
          "{{ auth()->user()->name }}"</h1>
        @if (count($shipments))
          @foreach ($shipments as $shipment)
            <div class="flex flex-col rounded-md border border-gray-600 p-4">
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
                <b
                  class="{{ $shipment->status == 'Awaiting Confirmation' ? 'text-red-500' : 'text-blue-500' }}">
                  {{ $shipment->status }}
                </b>
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
                <a href="{{ $shipment->status === 'Awaiting Confirmation' ? 'javascript:void(0)' : route('shipments.track', ['shipment' => $shipment->id]) }}"
                  class="{{ $shipment->status === 'Awaiting Confirmation' ? 'opacity-50 cursor-default' : '' }} me-1 rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                  @if ($shipment->status === 'Awaiting Confirmation') disabled @endif>
                  Shipment Overview
                </a>
              </div>
            </div>
          @endforeach
        @else
          <div class="flex flex-col rounded-md border border-gray-600 p-4">
            <h1 class="bold text-lg text-black">There are no shipments for
              "{{ auth()->user()->name }}" :-/</h1>
          </div>
        @endif

      </div>
    </div>
  </div>

</x-app-layout>
