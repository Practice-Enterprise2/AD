{{-- <div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2" for="receiver_name">Receiver Name</label>
    <input class="border border-gray-400 p-2 w-3/5 rounded-md" type="text" id="receiver_name" name="receiver_name">
</div> --}}
<x-app-layout>
  <div class="my-4 flex items-center justify-center">
    <div class="mx-auto w-3/5 rounded-md bg-white p-6 shadow-md">
      {{-- Current user --}}
      <h2 class="mb-4 text-sm font-medium text-black">
        Username: {{ auth()->user()->name }}
        Id: {{ auth()->user()->id }}
        Address: {{ auth()->user()->address }}

      </h2>
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
                <span class="text-black font-medium">{{ $shipment->source_address->street }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    House Number:
                </b>
                <span class="text-black font-medium">{{ $shipment->source_address->house_number }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    Postal Code:
                </b>
                <span class="text-black font-medium">{{ $shipment->source_address->postal_code }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    City:
                </b>
                <span class="text-black font-medium">{{ $shipment->source_address->city }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    Region:
                </b>
                <span class="text-black font-medium">{{ $shipment->source_address->region }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-4 inline-block text-black">
                    Country:
                </b>
                <span class="text-black font-medium">{{ $shipment->source_address->country }}</span>
            </p>
            <p class="text-sm text-black">
                <span class="mb-2 inline-block text-lg font-medium text-black underline">
                    Shipment Destination Address:
                </span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    Street:
                </b>
                <span class="text-black font-medium">{{ $shipment->destination_address->street }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    House Number:
                </b>
                <span class="text-black font-medium">{{ $shipment->destination_address->house_number }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    Postal Code:
                </b>
                <span class="text-black font-medium">{{ $shipment->destination_address->postal_code }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    City:
                </b>
                <span class="text-black font-medium">{{ $shipment->destination_address->city }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-2 inline-block text-black">
                    Region:
                </b>
                <span class="text-black font-medium">{{ $shipment->destination_address->region }}</span>
            </p>
            <p class="text-sm text-black">
                <b class="mb-4 inline-block text-black">
                    Country:
                </b>
                <span class="text-black font-medium">{{ $shipment->destination_address->country }}</span>
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
      {{-- {{ route('shipments.store') }} --}}
      {{-- {{ route('shipments.requests.evaluate.set.store') }} --}}
      <form
        action="{{ route('shipments.requests.evaluate.set.store', ['shipment' => $shipment]) }}"
        method="POST">
        @csrf
        <h1 class="mb-2 text-xl font-bold text-black underline">Set Waypoints
        </h1>

        <div class="space-y-2 text-black" id="waypoints-container">
          {{-- ORIGINAL INPUT BELOW: --}}
          {{-- <div class="waypoint">
                        <label class="block text-gray-700 font-medium mb-2" for="waypoint_1"> <b>Waypoint 1</b> Branch Address:</label>
                        <input class="border border-gray-400 p-2 w-3/5 rounded-md" type="text" name="waypoints[]" id="waypoint_1">
                    </div> --}}
        </div>

        <div class="mt-2">
          <button id="add-waypoint"
            class="rounded-md bg-green-500 p-2 text-white hover:bg-green-600"
            type="button">
            Add Waypoint
          </button>
          <button
            class="rounded-md bg-blue-500 p-2 text-white hover:bg-blue-600"
            type="submit">
            Submit
          </button>
        </div>
      </form>

    </div>

  </div>
</x-app-layout>

{{-- <script>
    $(document).ready(function() {
        var count = 0;
        $('#add-waypoint').click(function() {
            count++;

            var newWaypoint = $('<div/>', {
                'class': 'waypoint'
            });

            var label = $('<label/>', {
                'class': 'block text-gray-700 font-medium mb-2',
                'for': 'waypoint_' + count,
                html: '<b>Waypoint ' + count + ':</b> '
            });

            var input = $('<input/>', {
                'class': 'border border-gray-400 p-2 w-3/5 rounded-md',
                'type': 'text',
                'name': 'waypoints[]',
                'id': 'waypoint_' + count
            });

            newWaypoint.append(label);
            newWaypoint.append(input);
            $('#waypoints-container').append(newWaypoint);
        });
    });
</script> --}}

<script>
  $(document).ready(function() {
    var count = 0;
    $('#add-waypoint').click(function() {
      var newWaypoint = $('<div/>', {
        'class': 'waypoint'
      });

      var label = $('<label/>', {
        'class': 'block text-gray-700 font-medium mb-2 text-black',
        'for': 'waypoint_' + count,
        html: '<b class="text-black">Waypoint ' + count + ':</b> '
      });

      var streetInput = $('<input/>', {
        'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1 text-black',
        'type': 'text',
        'name': 'waypoints[' + count + '][street]',
        'id': 'waypoint_' + count + '_street',
        'placeholder': 'Street'
      });

      var houseNumberInput = $('<input/>', {
        'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1 text-black',
        'type': 'text',
        'name': 'waypoints[' + count + '][house_number]',
        'id': 'waypoint_' + count + '_house_number',
        'placeholder': 'House number'
      });

      var postalCodeInput = $('<input/>', {
        'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1 text-black',
        'type': 'text',
        'name': 'waypoints[' + count + '][postal_code]',
        'id': 'waypoint_' + count + '_postal_code',
        'placeholder': 'Postal code'
      });

      var cityInput = $('<input/>', {
        'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1 text-black',
        'type': 'text',
        'name': 'waypoints[' + count + '][city]',
        'id': 'waypoint_' + count + '_city',
        'placeholder': 'City'
      });

      var regionInput = $('<input/>', {
        'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1 text-black',
        'type': 'text',
        'name': 'waypoints[' + count + '][region]',
        'id': 'waypoint_' + count + '_region',
        'placeholder': 'Region'
      });

      var countryInput = $('<input/>', {
        'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1 text-black',
        'type': 'text',
        'name': 'waypoints[' + count + '][country]',
        'id': 'waypoint_' + count + '_country',
        'placeholder': 'Country'
      });

      count++;
      newWaypoint.append(label);
      newWaypoint.append(streetInput);
      newWaypoint.append(houseNumberInput);
      newWaypoint.append(postalCodeInput);
      newWaypoint.append(cityInput);
      newWaypoint.append(regionInput);
      newWaypoint.append(countryInput);

      $('#waypoints-container').append(newWaypoint);
    });
  });
</script>
