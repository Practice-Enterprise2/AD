{{-- <div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2" for="receiver_name">Receiver Name</label>
    <input class="border border-gray-400 p-2 w-3/5 rounded-md" type="text" id="receiver_name" name="receiver_name">
</div> --}}
<x-app-layout>
    <div class="h-screen flex items-center justify-center">
        <div class="w-3/5 mx-auto bg-white p-6 rounded-md shadow-md">
            {{-- Current user --}}
            <h2 class="text-sm font-medium mb-4">
                Username: {{ auth()->user()->name }}
                Id: {{ auth()->user()->id }}
                Address: {{ auth()->user()->address }}

            </h2>
            <h2 class="text-lg font-medium mb-4">Shipment for: <b>{{ $shipment->receiver_name }}</b></h2>
            <h2 class="text-lg font-medium mb-4">Source Address: <b>{{ $shipment->source_address }}</b></h2>
            <h2 class="text-lg font-medium mb-4">Destination address: <b>{{ $shipment->destination_address }}</b></h2>
            {{-- {{ route('shipments.store') }} --}}
            {{-- {{ route('shipments.requests.evaluate.set.store') }} --}}
            <form action="{{ route('shipments.requests.evaluate.set.store', ['shipment' => $shipment]) }}" method="POST">
                @csrf
                <h1 class="text-xl mb-2 underline font-bold">Set Waypoints</h1>

                <div class="space-y-2" id="waypoints-container">
                    {{-- ORIGINAL INPUT BELOW: --}}
                    {{-- <div class="waypoint">
                        <label class="block text-gray-700 font-medium mb-2" for="waypoint_1"> <b>Waypoint 1</b> Branch Address:</label>
                        <input class="border border-gray-400 p-2 w-3/5 rounded-md" type="text" name="waypoints[]" id="waypoint_1">
                    </div> --}}
                </div>

                <div class="mt-2">
                    <button
                        id="add-waypoint"
                        class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600"
                        type="button">
                        Add Waypoint
                    </button>
                    <button
                        class="bg-blue-500 text-white rounded-md hover:bg-blue-600 p-2"
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
            'class': 'block text-gray-700 font-medium mb-2',
            'for': 'waypoint_' + count,
            html: '<b>Waypoint ' + count + ':</b> '
        });

        var streetInput = $('<input/>', {
            'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1',
            'type': 'text',
            'name': 'waypoints[' + count + '][street]',
            'id': 'waypoint_' + count + '_street',
            'placeholder': 'Street'
        });

        var houseNumberInput = $('<input/>', {
            'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1',
            'type': 'text',
            'name': 'waypoints[' + count + '][house_number]',
            'id': 'waypoint_' + count + '_house_number',
            'placeholder': 'House number'
        });

        var postalCodeInput = $('<input/>', {
            'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1',
            'type': 'text',
            'name': 'waypoints[' + count + '][postal_code]',
            'id': 'waypoint_' + count + '_postal_code',
            'placeholder': 'Postal code'
        });

        var cityInput = $('<input/>', {
            'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1',
            'type': 'text',
            'name': 'waypoints[' + count + '][city]',
            'id': 'waypoint_' + count + '_city',
            'placeholder': 'City'
        });

        var regionInput = $('<input/>', {
            'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1',
            'type': 'text',
            'name': 'waypoints[' + count + '][region]',
            'id': 'waypoint_' + count + '_region',
            'placeholder': 'Region'
        });

        var countryInput = $('<input/>', {
            'class': 'border border-gray-400 p-2 w-3/5 rounded-md mb-1',
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

