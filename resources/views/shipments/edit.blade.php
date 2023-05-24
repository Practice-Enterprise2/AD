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
      <h2 class="mb-4 text-lg font-medium text-black">Update Shipment</h2>
      <form action="{{ route('shipments.update', $shipment->id) }}"
        method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="sender_id" value="{{ auth()->user()->id }}">

        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700"
            for="receiver_name">Receiver Name</label>
          <input class="w-3/5 rounded-md border border-gray-400 p-2 text-black"
            type="text" id="receiver_name" name="receiver_name"
            value="{{ $shipment->receiver_name }}">
        </div>
        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700"
            for="receiver_email">Receiver Email</label>
          <input class="w-3/5 rounded-md border border-gray-400 p-2 text-black"
            type="receiver_email" id="receiver_email" name="receiver_email"
            value="{{ $shipment->receiver_email }}">
        </div>
        {{--
                $table->foreignId('source_address_id');
                $table->foreignId('receiver_address_id'); // receiver address obj. will be created after shipment request is done.
                $table->string("receiver_full_name");
            --}}
        <div class="mb-4">
          <div class="mb-2">
            <p class="font-medium text-black text-gray-700 underline">
              Status:</p>
          </div></label>
          <div class="flex flex-col">
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="status"
                value="Awaiting Confirmation"
                @if ($shipment->status == 'Awaiting Confirmation') checked @endif>
              <span class="ml-2 text-black">Awaiting Confirmation</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="status"
                value="In Transit"
                @if ($shipment->status == 'In Transit') checked @endif>
              <span class="ml-2 text-black">In Transit</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="status"
                value="Out for Delivery"
                @if ($shipment->status == 'Out For Delivery') checked @endif>
              <span class="ml-2 text-black">Out for Delivery</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="status"
                value="Awaiting Pickup"
                @if ($shipment->status == 'Awaiting Pickup') checked @endif>
              <span class="ml-2 text-black">Awaiting Pickup</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="status"
                value="Delivered"
                @if ($shipment->status == 'Delivered') checked @endif>
              <span class="ml-2 text-black">Delivered</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="status"
                value="Cancelled"
                @if ($shipment->status == 'Cancelled') checked @endif>
              <span class="ml-2 text-black">Cancelled</span>
            </label>
          </div>
        </div>
        <div class="my-10">
          <div class="mb-4">
            <p class="font-medium text-gray-700 underline">Source Address
              Details:</p>
          </div>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Country:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_country"
                value="{{ $shipment->source_address->country }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_postalcode"
                value="{{ $shipment->source_address->postal_code }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_city"
                value="{{ $shipment->source_address->city }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_region"
                value="{{ $shipment->source_address->region }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_street"
                value="{{ $shipment->source_address->street }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_housenumber"
                value="{{ $shipment->source_address->house_number }}"
                onkeyup="disableSubmit();">
            </div>
          </div>
        </div>

        <div class="my-10">
          <div class="mb-4">
            <p class="font-medium text-black text-gray-700 underline">
              Destination Address Details:</p>
          </div>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Country:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_country"
                value="{{ $shipment->destination_address->country }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_postalcode"
                value="{{ $shipment->destination_address->postal_code }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_city"
                value="{{ $shipment->destination_address->city }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_region"
                value="{{ $shipment->destination_address->region }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_street"
                value="{{ $shipment->destination_address->street }}"
                onkeyup="disableSubmit();">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_housenumber"
                value="{{ $shipment->destination_address->house_number }}"
                onkeyup="disableSubmit();">
            </div>
          </div>
        </div>
        <div class="mb-4">
          <div class="mb-2">
            <p class="font-medium text-black text-gray-700 underline">
              Handling
              Type:</p>
          </div></label>
          <div class="flex flex-col">
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Standart"
                @if ($shipment->type == 'Standart') checked @endif>
              <span class="ml-2 text-black">Standart</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Fragile"
                @if ($shipment->type == 'Fragile') checked @endif>
              <span class="ml-2 text-black">Fragile</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Hazardous"
                @if ($shipment->type == 'Hazardous') checked @endif>
              <span class="ml-2 text-black">Hazardous</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Liquid"
                @if ($shipment->type == 'Liquid') checked @endif>
              <span class="ml-2 text-black">Liquid</span>
            </label>
          </div>
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
        <a href="{{ route('shipments.index') }}"
          class="rounded-md bg-red-500 px-4 py-2 text-white hover:bg-red-600">Cancel</a>
        <button
          class="rounded-md bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600"
          onclick="getAddress()">Check Address</button>

        <button
          class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 disabled:bg-blue-200"
          id="submitBtn" type="submit">
          Update Shipment</button>
        <div class="text-black">
          <h2 id="addressInfo" class="text-black"></h2>
          <h2 id="addressError" class="text-red-600"></h2>
        </div>

        <div id="map" style="width:650px; height:450px;"></div>
    </div>
    </form>
    <script type="text/javascript"
      src="https://www.bing.com/api/maps/mapcontrol?key=ArfpIw0134XZnw8MWg9XmhlgicET7kV9fOElPvnnVw0COUFNWvmSUTor3nyQFiId">
    </script>
    <script>
      function disableSubmit() {
        document.getElementById('submitBtn').disabled = true;
      }
      async function getAddress() {
        event.preventDefault();
        const country = document.getElementsByName('source_country')[0].value;
        const city = document.getElementsByName('source_city')[0].value;
        const postalcode = document.getElementsByName('source_postalcode')[0]
          .value;
        const street = document.getElementsByName('source_street')[0].value;
        const houseNumber = document.getElementsByName('source_housenumber')[0]
          .value;
        const address = street + ' ' + houseNumber;
        const region = document.getElementsByName('source_region')[0].value;
        const toregion = document.getElementsByName('destination_region')[0]
          .value;
        const tocountry = document.getElementsByName('destination_country')[0]
          .value;
        const tocity = document.getElementsByName('destination_city')[0].value;
        const topostalcode = document.getElementsByName('destination_postalcode')[
          0].value;
        const toStreet = document.getElementsByName('destination_street')[0]
          .value;
        const toSouseNumber = document.getElementsByName(
          'destination_housenumber')[0].value;
        const toAddress = toStreet + ' ' + toSouseNumber;
        let check = false;
        let map;
        let departureData, destinationData;
        let departurePin, destinationPin;
        let departureInfo, destinationInfo;
        let departureLocation, destinationLocation;
        let addressError = document.getElementById('addressError');
        let addressInfo = document.getElementById('addressInfo');
        addressError.textContent = '';
        addressInfo.textContent = '';
        if (country.trim() === '' || city.trim() === '' || postalcode.trim() ===
          '' || address.trim() === '' || tocountry.trim() === '' || tocity
          .trim() === '' || topostalcode.trim() === '' || toAddress.trim() === ''
        ) {
          return addressError.textContent = "Please fill in all the fields";
        } else {
          // the rest of your code
          await fetch(
              `https://dev.virtualearth.net/REST/v1/Locations?CountryRegion=${encodeURIComponent(country)}&state=${encodeURIComponent(region)}&locality=${encodeURIComponent(city)}&postalCode=${encodeURIComponent(postalcode)}&addressLine=${encodeURIComponent(address)}&key=ArfpIw0134XZnw8MWg9XmhlgicET7kV9fOElPvnnVw0COUFNWvmSUTor3nyQFiId`
            )
            .then(response => response.json())
            .then(data => {
              // Extract the latitude and longitude from the response
              if (data.resourceSets[0].resources.length > 0) {
                if (data.resourceSets[0].resources[0].confidence === "High" &&
                  data.resourceSets[0].resources[0].entityType === "Address") {
                  const departureLat = data.resourceSets[0].resources[0]
                    .geocodePoints[0].coordinates[0];
                  const departureLng = data.resourceSets[0].resources[0]
                    .geocodePoints[0].coordinates[1];
                  console.log(data.resourceSets[0].resources[0]);
                  departureData = data.resourceSets[0].resources[0];
                  departureInfo = data.resourceSets[0].resources[0].address
                    .formattedAddress
                  departureLocation = new Microsoft.Maps.Location(departureLat,
                    departureLng)

                  // // Create a pushpin for the departure location
                  departurePin = new Microsoft.Maps.Pushpin(departureLocation);
                  // map.entities.push(departurePin);

                  // Chain the second fetch call inside the first fetch call's callback
                  return fetch(
                    `https://dev.virtualearth.net/REST/v1/Locations?CountryRegion=${encodeURIComponent(tocountry)}&state=${encodeURIComponent(toregion)}&locality=${encodeURIComponent(tocity)}&postalCode=${encodeURIComponent(topostalcode)}&addressLine=${encodeURIComponent(toAddress)}&key=ArfpIw0134XZnw8MWg9XmhlgicET7kV9fOElPvnnVw0COUFNWvmSUTor3nyQFiId`
                  );
                } else {
                  return addressError.textContent = "source address not exists";
                }
              } else {
                return addressError.textContent = "source address not exists";
              }
            })
            .then(response => {
              if (!response) {
                return 0;
              }
              return response.json();
            })
            .then(data => {
              // Extract the latitude and longitude from the response
              if (data) {
                if (data.resourceSets[0].resources.length > 0) {
                  if (data.resourceSets[0].resources[0].confidence === "High" &&
                    data.resourceSets[0].resources[0].entityType === "Address"
                  ) {
                    const destinationLat = data.resourceSets[0].resources[0]
                      .geocodePoints[0].coordinates[0];
                    const destinationLng = data.resourceSets[0].resources[0]
                      .geocodePoints[0].coordinates[1];
                    console.log(data.resourceSets[0].resources[0]);
                    destinationData = data.resourceSets[0].resources[0];
                    destinationInfo = data.resourceSets[0].resources[0].address
                      .formattedAddress
                    destinationLocation = new Microsoft.Maps.Location(
                      destinationLat, destinationLng);
                    check = true;
                    document.getElementsByName('source_country')[0].value =
                      departureData.address.countryRegion;
                    document.getElementsByName('source_city')[0].value =
                      departureData.address.locality;
                    document.getElementsByName('source_postalcode')[0].value =
                      departureData.address.postalCode;
                    document.getElementsByName('source_region')[0].value =
                      departureData.address.adminDistrict;
                    document.getElementsByName('destination_country')[0].value =
                      destinationData.address.countryRegion;
                    document.getElementsByName('destination_city')[0].value =
                      destinationData.address.locality;
                    document.getElementsByName('destination_postalcode')[0]
                      .value = destinationData.address.postalCode;
                    document.getElementsByName('destination_region')[0].value =
                      destinationData.address.adminDistrict;
                    map = new Microsoft.Maps.Map("#map", {
                      credentials: 'ArfpIw0134XZnw8MWg9XmhlgicET7kV9fOElPvnnVw0COUFNWvmSUTor3nyQFiId',
                      center: new Microsoft.Maps.Location(destinationLat,
                        destinationLng),
                      bounds: Microsoft.Maps.LocationRect.fromLocations(
                        destinationLocation, departureLocation),
                      zoom: 12
                    });
                    // Create a pushpin for the destination location
                    destinationPin = new Microsoft.Maps.Pushpin(new Microsoft
                      .Maps.Location(destinationLat, destinationLng));
                    map.entities.push(departurePin);

                    map.entities.push(destinationPin);

                    Microsoft.Maps.loadModule('Microsoft.Maps.SpatialMath',
                      function() {
                        console.log(Microsoft.Maps.SpatialMath.getDistanceTo(
                          departurePin.getLocation(), destinationPin
                          .getLocation(), Microsoft.Maps.SpatialMath
                          .DistanceUnits.Kilometers));
                        var locations = Microsoft.Maps.SpatialMath
                          .getGeodesicPath([departurePin.getLocation(),
                            destinationPin.getLocation()
                          ]);
                        var polyline = new Microsoft.Maps.Polyline(
                          locations, {
                            strokeThickness: 3
                          });
                        map.entities.push(polyline);
                      });
                  } else {
                    return addressError.textContent =
                      "destination address not exists";
                  }
                } else {
                  return addressError.textContent =
                    "destination address not exists";
                }
              }
            })
            .catch(error => {
              console.error(error);
            });
          if (check) {
            document.getElementById('submitBtn').disabled = false;
            addressInfo.textContent = "From: " +
              departureInfo + " To: " + destinationInfo;
          }

        }

      }
    </script>
    </form>
  </div>
  </div>
</x-app-layout>
