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
            type="text" id="receiver_name" name="receiver_name">
            @error('receiver_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700"
            for="receiver_email">Receiver Email</label>
          <input class="w-3/5 rounded-md border border-gray-400 p-2 text-black"
            type="receiver_email" id="receiver_email" name="receiver_email">
            @error('receiver_email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
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
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_country">
            </div>
            @error('source_country')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_postalcode">
            </div>
            @error('source_postalcode')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_city">
            </div>
            @error('source_city')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_region">
            </div>
            @error('source_region')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_street">
            </div>
            @error('source_street')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_housenumber">
            </div>
            @error('source_housenumber')
                <div class="text-danger">{{ $message }}</div>
                @enderror
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
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_country">
            </div>
            @error('destination_country')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_postalcode">
            </div>
            @error('destination_postalcode')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_city">
            </div>
            @error('destination_city')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_region">
            </div>
            @error('destination_region')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_street">
            </div>
            @error('destination_street')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_housenumber">
            </div>
            @error('destination_housenumber')
                <div class="text-danger">{{ $message }}</div>
                @enderror
          </div>
        </div>
        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700">Handling
            Type</label>
          <div class="flex flex-col">
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Standart">
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
        @error('handling_type')
                <div class="text-danger">{{ $message }}</div>
                @enderror
        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700">Package
            details</label>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Total
                weight:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_weight" id="shipment_weight">
            </div>
            @error('shipment_weight')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Length:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_length" id="shipment_length">
            </div>
            @error('shipment_length')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Height:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_height" id="shipment_height">
            </div>
            @error('shipment_height')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Width:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_width" id="shipment_width">
            </div>
            @error('shipment_width')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Expense:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_expense" id="shipment_expense">
                
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Preferred
                date of
                delivery:</label>
              <!-- Read out initialised delivery dates list of following 7 days -->
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
              <input type="hidden" name="shipment_date" id="shipment_date">
              <span id="shipment_date_display"
                class="ml-auto w-2/3 p-1 text-black"></span>
              <!-- Script to calculate estimated shipping date compared to selected preferred delivery date -->
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
        <button
          class="rounded-md bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600"
          onclick="getAddress()">Check Address</button>
        <button
          class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 disabled:opacity-50"
          type="submit" id="submitBtn" disabled>Submit</button>
          <div class=" text-black">
            <h2  id="addressInfo" class=" text-black"></h2>
          </div>
          
          <div id="map" style="width:650px; height:450px;"></div>
    </div>
    </form>
    <script type="text/javascript" src="https://www.bing.com/api/maps/mapcontrol?key=ArfpIw0134XZnw8MWg9XmhlgicET7kV9fOElPvnnVw0COUFNWvmSUTor3nyQFiId"></script>
      <script>
			async function getAddress()
			{
        event.preventDefault();
			const country = document.getElementsByName('source_country')[0].value;
			const city = document.getElementsByName('source_city')[0].value;
			const postalcode = document.getElementsByName('source_postalcode')[0].value;
			const street = document.getElementsByName('source_street')[0].value;
			const houseNumber = document.getElementsByName('source_housenumber')[0].value;
      const address = street+ ' ' + houseNumber;
			const tocountry = document.getElementsByName('destination_country')[0].value;
			const tocity = document.getElementsByName('destination_city')[0].value;
			const topostalcode = document.getElementsByName('destination_postalcode')[0].value;
      const toStreet = document.getElementsByName('destination_street')[0].value;
			const toSouseNumber = document.getElementsByName('destination_housenumber')[0].value;
			const toAddress = toStreet+ ' ' + toSouseNumber;
			let check = false;
			let map;
			let departurePin, destinationPin;
      let departureInfo, destinationInfo;
			if (country.trim() === '' || city.trim() === '' || postalcode.trim() === '' || address.trim() === '' || tocountry.trim() === '' || tocity.trim() === '' || topostalcode.trim() === '' || toAddress.trim() === '') {
			alert('Please fill in all the fields');
			} else {
  // the rest of your code
			await fetch(`https://dev.virtualearth.net/REST/v1/Locations?CountryRegion=${encodeURIComponent(country)}&locality=${encodeURIComponent(city)}&postalCode=${encodeURIComponent(postalcode)}&addressLine=${encodeURIComponent(address)}&key=ArfpIw0134XZnw8MWg9XmhlgicET7kV9fOElPvnnVw0COUFNWvmSUTor3nyQFiId`)
			.then(response => response.json())
			.then(data => {
				// Extract the latitude and longitude from the response
				if(data.resourceSets[0].resources.length > 0){
					if(data.resourceSets[0].resources[0].confidence === "High" && data.resourceSets[0].resources[0].entityType === "Address")
					{
					const departureLat = data.resourceSets[0].resources[0].geocodePoints[0].coordinates[0];
					const departureLng = data.resourceSets[0].resources[0].geocodePoints[0].coordinates[1];
					console.log(data.resourceSets[0].resources[0]);
					departureInfo = data.resourceSets[0].resources[0].address.formattedAddress


					// // Create a pushpin for the departure location
					departurePin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(departureLat, departureLng));
					// map.entities.push(departurePin);

					// Chain the second fetch call inside the first fetch call's callback
					return fetch(`https://dev.virtualearth.net/REST/v1/Locations?CountryRegion=${encodeURIComponent(tocountry)}&locality=${encodeURIComponent(tocity)}&postalCode=${encodeURIComponent(topostalcode)}&addressLine=${encodeURIComponent(toAddress)}&key=ArfpIw0134XZnw8MWg9XmhlgicET7kV9fOElPvnnVw0COUFNWvmSUTor3nyQFiId`);
					}
					else
					{
					return alert("address not exists");
					}
				}
				else
				{ 
					return alert("address not exists");
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
				if(data)
				{
					if(data.resourceSets[0].resources.length > 0){
						if(data.resourceSets[0].resources[0].confidence === "High" && data.resourceSets[0].resources[0].entityType === "Address")
						{
						const destinationLat = data.resourceSets[0].resources[0].geocodePoints[0].coordinates[0];
						const destinationLng = data.resourceSets[0].resources[0].geocodePoints[0].coordinates[1];
						console.log(data.resourceSets[0].resources[0]);
            destinationInfo = data.resourceSets[0].resources[0].address.formattedAddress
						check = true;
						map = new Microsoft.Maps.Map("#map", {
              credentials:'ArfpIw0134XZnw8MWg9XmhlgicET7kV9fOElPvnnVw0COUFNWvmSUTor3nyQFiId',
						center: new Microsoft.Maps.Location(destinationLat, destinationLng),
						zoom: 12
						});
						// Create a pushpin for the destination location
						destinationPin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(destinationLat, destinationLng));
						map.entities.push(departurePin);

						map.entities.push(destinationPin);

						Microsoft.Maps.loadModule('Microsoft.Maps.SpatialMath', function() {
							console.log(Microsoft.Maps.SpatialMath.getDistanceTo(departurePin.getLocation(), destinationPin.getLocation(), Microsoft.Maps.SpatialMath.DistanceUnits.Kilometers));
							var locations = Microsoft.Maps.SpatialMath.getGeodesicPath([departurePin.getLocation(), destinationPin.getLocation()]);
							var polyline = new Microsoft.Maps.Polyline(locations, { strokeThickness: 3 });
							map.entities.push(polyline);
						});
						}
						else
						{
							return alert("address not exists");
						}
					}
					else
					{
						return alert("address not exists");
					}
				}
			})
			.catch(error => {
				console.error(error);
			});
			if(check)
			{
				document.getElementById('submitBtn').disabled = false;
        document.getElementById('addressInfo').textContent = "From: " + departureInfo + "To: " + destinationInfo ;
			}
			
		}
			
		}
		  </script>
  </div>
  </div>
</x-app-layout>
