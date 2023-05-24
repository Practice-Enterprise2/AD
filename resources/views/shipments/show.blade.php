{{-- -*-html-*- --}}

<x-app-layout>
  <div class="my-4 flex items-center justify-center">
    <div class="mx-auto w-3/5 space-y-6 rounded-md bg-white p-6 shadow-md">
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
          <div class="space-y-2 px-2">
            <hr class="my-4 border border-gray-500">
            @foreach ($shipment->waypoints as $waypoint)
              <div>
                <p class="text-sm text-black">
                  <span
                    class="mb-4 inline-block text-lg font-medium text-black underline">
                    Waypoint with id:
                  </span>
                  <span class="text-black">{{ $waypoint->id }}</span>
                </p>
                <p class="text-sm text-black">
                  <span
                    class="mb-4 inline-block text-lg font-medium text-black underline">
                    Waypoint status:
                  </span>
                  <b class="text-black">{{ $waypoint->status }}</b>
                </p>
                <p class="text-sm text-black">
                  <span
                    class="mb-2 inline-block text-lg font-medium text-black underline">
                    Current Address:
                  </span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    Street:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->current_address->street }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    House Number:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->current_address->house_number }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    Postal Code:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->current_address->postal_code }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    City:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->current_address->city }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    Region:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->current_address->region }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-4 inline-block text-black">
                    Country:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->current_address->country }}</span>
                </p>

                <p class="text-sm text-black">
                  <span
                    class="mb-2 inline-block text-lg font-medium text-black underline">
                    Next Address:
                  </span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    Street:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->next_address->street }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    House Number:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->next_address->house_number }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    Postal Code:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->next_address->postal_code }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    City:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->next_address->city }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-2 inline-block text-black">
                    Region:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->next_address->region }}</span>
                </p>
                <p class="text-sm text-black">
                  <b class="mb-4 inline-block text-black">
                    Country:
                  </b>
                  <span
                    class="font-medium text-black">{{ $waypoint->next_address->country }}</span>
                </p>
                <hr class="my-4 border border-gray-500">
              </div>
            @endforeach
          </div>
          @can('edit_all_shipments')
            <div class="mb-4 flex justify-end border p-2">
              {{ QrCode::size(200)->generate(route('shipments.update-waypoint', ['shipment' => $shipment->id])) }}
            </div>
            <div class="mb-2 flex justify-end">
              <form action="{{ route('shipments.edit', $shipment->id) }}"
                method="GET">
                @csrf
                <button
                  class="me-1 rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                  type="submit">
                  Edit</button>
              </form>
            @endcan
            @can('delete_any_shipment')
              <form action="{{ route('shipments.destroy', $shipment->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button
                  class="rounded-md bg-red-500 px-4 py-2 text-white hover:bg-red-600"
                  type="submit">
                  Delete</button>
              </form>
            @endcan
          </div>
        </div>

      </div>
    </div>
  </div>

</x-app-layout>
