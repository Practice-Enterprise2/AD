{{-- -*-html-*- --}}

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
        <span class="mb-4 inline-block text-lg font-medium text-black underline">
          Shipment with id: </span>
        <span class="text-black">{{ $shipment->id }}</span>
      </p>
      <p class="text-sm text-black">
        <span class="mb-4 inline-block text-lg font-medium text-black underline">
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
      <form
        action="{{ route('shipments.requests.evaluate.set.store', ['shipment' => $shipment]) }}"
        method="POST">
        @csrf
        <h1 class="mb-2 text-xl font-bold text-black underline">Set Waypoints
        </h1>

        <div class="space-y-2 text-black" id="waypoints-container">
        </div>
        @if ($errors->any())
          <div class="mb-4">
            <label class="block font-medium text-red-700">Errors:</label>
            <ul>
              @foreach ($errors->all() as $error)
                <li class="block font-medium text-black">-{{ $error }}
                </li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="mt-2">
          <button id="add-depot"
            class="rounded-md bg-green-500 p-2 text-white hover:bg-green-600"
            type="button">Add Branch</button>

          <button id="add-airport"
            class="rounded-md bg-blue-500 p-2 text-white hover:bg-blue-600"
            type="button">Add Airport</button>
          <button
            class="rounded-md bg-blue-500 p-2 text-white hover:bg-blue-600"
            type="submit">
            Submit
          </button>
        </div>
      </form>

    </div>

  </div>

  <script type="module">
    $(document).ready(function() {

      //used as index numbers within the array in request.
      var count = 0;

      //prev_type to ensure hiddenInput does not get wrong type.
      var prev_type;

      //add depot
      $('#add-depot').click(function() {
        var type = 'depot';
        // Create a new select element
        var title = $('<h1/>', {
          'class': 'text-black font-bold',
          'for': 'waypoint_' + count + '_' + type + '_id',
          'html': 'Waypoint[' + (count) + ']: ' + type.charAt(0)
            .toUpperCase() + type.slice(1)
        });
        if (count > 0) {
          var prevWaypoint = $('.waypoint-select').eq(count-1);
          var hiddenInput = $('<input/>', {
            'type': 'hidden',
            'name': 'waypoints[' + (count-1) + '][' + prev_type + '_id]',
            'class': 'waypoint-hidden',
            'value': prevWaypoint.val()
          });
          prevWaypoint.prop('disabled', true);
        }
        $('.waypoint-select:last').prop('disabled', true);
        prev_type = type;
        var newWaypoint = $('<select/>', {
          'class': 'block w-full p-2 rounded-md shadow-sm focus:border-gray-500 focus:ring focus:ring-gray-500 focus:ring-opacity-50',
          'name': 'waypoints[' + count + '][' + type + '_id]',
          'id': 'waypoint_' + count + '_' + type + '_id'
        });
        // Populate the select element with options for each depot
        @foreach ($depots as $depot)
          var option = $('<option/>', {
            'value': '{{ $depot->id }}',
            html: 'DepotId: {{ $depot->id }} / Depot AddressId: {{ $depot->address->id }} / Depot Code: {{ $depot->code }} / Depot Address: {{ $depot->address->country }}, {{ $depot->address->region }}, {{ $depot->address->city }}, {{ $depot->address->postal_code }}, {{ $depot->address->street }}, {{ $depot->address->house_number }}'
          });
          // Check if the option is already selected in another select element
          if ($('.depot-select').find(
              ':selected[value="{{ $depot->id }}"]').length == 0) {
            newWaypoint.append(option);
          }
        @endforeach
        // class is added to check if the select option is already selected above
        newWaypoint.addClass('waypoint-select');
        newWaypoint.addClass('depot-select'); //this class needed to for the first if statement above.
        // Increment the count and append the new select element to the container
        count++;
        $('#waypoints-container').append(title);
        $('#waypoints-container').append(newWaypoint);
        $('#waypoints-container').append(hiddenInput);


        //checking if there are only 1 more item left to add to the select tag. if yes, add-item button will be disabled.
        var itemCount = newWaypoint.find('option').length;
        if(itemCount == 1)
        {
          $('#add-depot').prop('disabled', true);
          $('#add-depot').css('opacity', '0.5');
        }

      });


      //add airport
      $('#add-airport').click(function() {
        // later on airport will be converted to address from IATA
        var type = 'airport';
        // Create a new select element
        var title = $('<h1/>', {
          'class': 'text-black font-bold',
          'for': 'waypoint_' + count + '_' + type + '_id',
          'html': 'Waypoint[' + (count) + ']: ' + type.charAt(0)
            .toUpperCase() + type.slice(1)
        });
        if (count > 0) {
          var prevWaypoint = $('.waypoint-select').eq(count-1);
          var hiddenInput = $('<input/>', {
            'type': 'hidden',
            'name': 'waypoints[' + (count-1) + '][' + prev_type + '_id]',
            'class': 'waypoint-hidden',
            'value': prevWaypoint.val()
          });
          prevWaypoint.prop('disabled', true);
        }
        $('.waypoint-select:last').prop('disabled', true);
        prev_type = type;
        var newWaypoint = $('<select/>', {
          'class': 'block w-full p-2 rounded-md shadow-sm focus:border-gray-500 focus:ring focus:ring-gray-500 focus:ring-opacity-50',
          'name': 'waypoints[' + count + '][' + type + '_id]',
          'id': 'waypoint_' + count + '_' + type + '_id'
        });
        // Populate the select element with options for each depot
        @foreach ($airports as $airport)
          var option = $('<option/>', {
            'value': '{{ $airport->id }}',
            html: 'AirportId: {{ $airport->id }} / Airport AddressId: {{ $airport->address->id }} / Airport Name: {{ $airport->name }} / Airport Code: {{ $airport->code }} / Airport Address: {{ $airport->address->country }}, {{ $airport->address->region }}, {{ $airport->address->city }}, {{ $airport->address->postal_code }}, {{ $airport->address->street }}, {{ $airport->address->house_number }}'
          });
          // (!)
          // Check if the option is already selected in another select element
          if ($('.airport-select').find(
              ':selected[value="{{ $airport->id }}"]').length == 0) {
            newWaypoint.append(option);
          }
        @endforeach
        // class is added to check if the select option is already selected above
        newWaypoint.addClass('waypoint-select');
        newWaypoint.addClass('airport-select'); //this class needed to for the first if statement above.
        // Increment the count and append the new select element to the container
        count++;
        $('#waypoints-container').append(title);
        $('#waypoints-container').append(newWaypoint);
        $('#waypoints-container').append(hiddenInput);

        //checking if there are only 1 more item left to add to the select tag. if yes, add-item button will be disabled.
        var itemCount = newWaypoint.find('option').length;
        if(itemCount == 1)
        {
          $('#add-airport').prop('disabled', true);
          $('#add-airport').css('opacity', '0.5');
        }
      });
    });
  </script>

</x-app-layout>
