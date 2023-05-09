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
</x-app-layout>

<script>
  $(document).ready(function() {

    var count = 0;
    $('#add-depot, #add-airport').click(function() {

      // later on airport will be converted to address from IATA
      var type = $(this).attr('id') === 'add-depot' ? 'depot' :
        'airport';

      // Create a new select element
      var title = $('<h1/>', {
        'class': 'text-black font-bold',
        'for': 'waypoint_' + count + '_' + type + '_id',
        'html': 'Waypoint[' + (count) + ']: ' + type.charAt(0)
          .toUpperCase() + type.slice(1)
      });



      // (!) NEED TO BE ABLE TO DISABLE AND RETRIEVE THE VALUE AT THE SAME TIME.

      // var hiddenInput = $('<input/>', {
      // 'type': 'hidden',
      // 'name': 'waypoints[' + count + '][' + type + '_id]',
      // 'class': 'waypoint-hidden',
      // 'value': $('.waypoint-select').val()
      // });

      // $('.waypoint-select').prop('disabled', true);

      var newWaypoint = $('<select/>', {
        'class': 'block w-full p-2 rounded-md shadow-sm focus:border-gray-500 focus:ring focus:ring-gray-500 focus:ring-opacity-50',
        'name': 'waypoints[' + count + '][' + type + '_id]',
        'id': 'waypoint_' + count + '_' + type + '_id'
      });


      // Populate the select element with options for each depot
      @foreach ($depots as $depot)
        var option = $('<option/>', {
          'value': '{{ $depot->id }}',
          html: 'Depot Code: {{ $depot->code }} / Depot Address: {{ $depot->address->country }}, {{ $depot->address->region }}, {{ $depot->address->city }}, {{ $depot->address->postal_code }}, {{ $depot->address->street }}, {{ $depot->address->house_number }}'
        });

        // Check if the option is already selected in another select element
        if ($('.waypoint-select').find(
            ':selected[value="{{ $depot->id }}"]').length == 0) {
          newWaypoint.append(option);
        }
      @endforeach

      // class is added to check if the select option is already selected above
      newWaypoint.addClass('waypoint-select');

      // Increment the count and append the new select element to the container
      count++;
      $('#waypoints-container').append(title);
      $('#waypoints-container').append(newWaypoint);
      $('#waypoints-container').append(hiddenInput);
    });
  });
</script>

