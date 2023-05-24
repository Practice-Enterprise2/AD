{{-- -*-html-*- --}}

<x-app-layout>
  <div class="mt-6 flex flex-col items-center justify-center">
    <div class="mx-auto w-3/5 rounded-md bg-white p-6 shadow-md">
      {{-- Current user --}}
      <h2 class="mb-4 text-sm font-medium text-black">
        Username: {{ auth()->user()->name }}
        Id: {{ auth()->user()->id }}
        Address: {{ auth()->user()->address }}

      </h2>
      <h2 class="mb-4 text-lg font-medium text-black">Request Shipment</h2>
      <form action="{{ route('shipments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="sender_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="sender_address"
          value="{{ auth()->user()->address }}">

        {{-- User address attributes needs to be fetched here
            <input type="hidden"  name="sender_address_id" value="{{ auth()->user()->adress_id }}"> --}}

        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700"
            for="receiver_name">Receiver Name</label>
          <input class="w-3/5 rounded-md border border-gray-400 p-2 text-black"
            type="text" id="receiver_name" name="receiver_name"
            value="{{ old('receiver_name') }}">
        </div>
        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700"
            for="receiver_email">Receiver Email</label>
          <input class="w-3/5 rounded-md border border-gray-400 p-2 text-black"
            type="receiver_email" id="receiver_email" name="receiver_email"
            value="{{ old('receiver_email') }}">
        </div>
        {{--
                $table->foreignId('source_address_id');
                $table->foreignId('receiver_address_id'); // receiver address obj. will be created after shipment request is done.
                $table->string("receiver_full_name");
            --}}
        <div class="my-10">
          <div class="mb-4">
            <p class="font-medium text-gray-700 underline">Source Address
              Details:</p>
          </div>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Country:</label>
              <select
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                name="source_country" onchange="disableSubmit();">
                <option value="">Select a country</option>
                @foreach ($countries as $country)
                  <option value="{{ $country }}"
                    @if (old('source_country') == $country) selected @endif>
                    {{ $country }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_postalcode"
                onkeyup="disableSubmit();"
                value="{{ old('source_postalcode') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_city" onkeyup="disableSubmit();"
                value="{{ old('source_city') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_region" onkeyup="disableSubmit();"
                value="{{ old('source_region') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_street" onkeyup="disableSubmit();"
                value="{{ old('source_street') }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_housenumber"
                onkeyup="disableSubmit();"
                value="{{ old('source_housenumber') }}">
            </div>
          </div>
        </div>

        <div class="my-10">
          <div class="mb-4">
            <p class="font-medium text-gray-700 underline">
              Destination Address Details:</p>
          </div>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Country:</label>
              <select
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                name="destination_country" onchange="disableSubmit();">
                <option value="">Select a country</option>
                @foreach ($countries as $country)
                  <option value="{{ $country }}"
                    @if (old('destination_country') == $country) selected @endif>
                    {{ $country }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_postalcode"
                onkeyup="disableSubmit();"
                value="{{ old('destination_postalcode') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_city"
                onkeyup="disableSubmit();"
                value="{{ old('destination_city') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_region"
                onkeyup="disableSubmit();"
                value="{{ old('destination_region') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_street"
                onkeyup="disableSubmit();"
                value="{{ old('destination_street') }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_housenumber"
                onkeyup="disableSubmit();"
                value="{{ old('destination_housenumber') }}">
            </div>
          </div>
        </div>
        <div class="my-10">
          <label
            class="mb-2 block font-medium text-gray-700 underline">Handling
            Type:</label>
          <div class="flex flex-col">
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Standart" checked>
              <span class="ml-2 text-black">Standard</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Fragile">
              <span class="ml-2 text-black">Fragile</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Hazardous">
              <span class="ml-2 text-black">Hazardous</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Liquid">
              <span class="ml-2 text-black">Liquid</span>
            </label>
          </div>
        </div>
        <div class="my-10">
          <label class="mb-2 block font-medium text-gray-700 underline">Package
            details:</label>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Total
                weight: (kg)</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_weight" id="shipment_weight"
                value="{{ old('shipment_weight') }}"
                onkeyup="calculateShipmentPrice()">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Length:
                (cm)</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_length" id="shipment_length"
                value="{{ old('shipment_length') }}"
                onkeyup="calculateShipmentPrice()">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Height:
                (cm)</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_height" id="shipment_height"
                value="{{ old('shipment_height') }}"
                onkeyup="calculateShipmentPrice()">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Width:
                (cm)</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_width" id="shipment_width"
                value="{{ old('shipment_width') }}"
                onkeyup="calculateShipmentPrice()">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Expense:
                (Euro)</label>
              <input readonly
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_price" id="shipment_price"
                value="{{ old('shipment_price') }}">
            </div>
            <input name="shipment_distance" id="shipment_distance"
              value="{{ old('shipment_distance') }}" type="hidden"
              onkeyup="calculateShipmentPrice()">
            <script type="text/javascript">
              function calculateShipmentPrice() {
                var shipment_distance = document.getElementById('shipment_distance').value;
                console.log(shipment_distance);
                var shipment_weight = document.getElementById('shipment_weight').value;
                var shipment_length = document.getElementById('shipment_length').value;
                var shipment_height = document.getElementById('shipment_height').value;
                var shipment_width = document.getElementById('shipment_width').value;
                var shipment_price = document.getElementById('shipment_price');
                if (shipment_weight == '' || shipment_length == '' || shipment_height ==
                  '' || shipment_width == '' || shipment_distance == '') {
                  shipment_price.value = 0;
                  return;
                }
                var price = 0;
                var volumetric_freight = 0;
                var volumetric_freight_tarrif = 5;
                var dense_cargo_tarrif = 4;
                var expense_excl_VAT = 0;
                var VAT_percentage = 0;
                volumetric_freight += ((shipment_length * shipment_width *
                  shipment_height) / 5000);
                if (volumetric_freight > shipment_weight) {
                  price = volumetric_freight * volumetric_freight_tarrif *
                    shipment_distance;
                } else {
                  price = shipment_height * dense_cargo_tarrif * shipment_distance;
                }
                var ceilPrice = Math.ceil(price);
                shipment_price.value = ceilPrice;
              }
            </script>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Preferred
                date of
                delivery:</label>
              {{-- Read out initialised delivery dates list of following 7 days --}}
              <select name="delivery_date" id="delivery_date"
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black">
                @foreach ($deliveryDates as $date)
                  <option value="{{ $date }}" class="text-black">
                    {{ $date }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Estimated
                date of
                shipping: </label>
              <input type="hidden" name="shipment_date" id="shipment_date"
                value="{{ date('Y-m-d') }}">
              <span id="shipment_date_display"
                class="ml-auto w-2/3 p-1 text-black">
                {{ date('Y-m-d') }}</span>
              {{-- Script to calculate estimated shipping date compared to selected preferred delivery date --}}
              <script>
                const deliveryDateSelected = document.getElementById('delivery_date');
                const estimatedShippingDateInput = document.getElementById('shipment_date');
                const estimatedShippingDateDisplay = document.getElementById(
                  'shipment_date_display');
                deliveryDateSelected.addEventListener('change', function() {
                  const selectedDate = new Date(this.value);
                  const estimatedShippingDate = new Date(selectedDate.getTime() - 2 * 24 *
                    60 * 60 * 1000);
                  const formattedDate = estimatedShippingDate.toISOString().split('T')[0];
                  estimatedShippingDateInput.value = formattedDate;
                  estimatedShippingDateDisplay.textContent = formattedDate;
                });
              </script>
            </div>
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
        <button
          class="rounded-md bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600"
          onclick="getAddress()">Check Address</button>
        <button
          class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 disabled:opacity-50"
          type="submit" id="submitBtn" disabled>Submit</button>
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
                        var distance = Microsoft.Maps.SpatialMath
                          .getDistanceTo(
                            departurePin.getLocation(), destinationPin
                            .getLocation(), Microsoft.Maps.SpatialMath
                            .DistanceUnits.Kilometers);
                        const distanceInfo = document.getElementById(
                          'shipment_distance');
                        shipment_distance.value = distance;
                        calculateShipmentPrice();
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
  </div>
  </div>
</x-app-layout>
