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
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_country"
                value="{{ old('source_country') }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_postalcode"
                value="{{ old('source_postalcode') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_city"
                value="{{ old('source_city') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_region"
                value="{{ old('source_region') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_street"
                value="{{ old('source_street') }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_housenumber"
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
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_country"
                value="{{ old('destination_country') }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_postalcode"
                value="{{ old('destination_postalcode') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_city"
                value="{{ old('destination_city') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_region"
                value="{{ old('destination_region') }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_street"
                value="{{ old('destination_street') }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_housenumber"
                value="{{ old('destination_housenumber') }}">
            </div>
          </div>
        </div>
        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700">Handling
            Type</label>
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
        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700">Package
            details</label>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Total
                weight:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_weight" id="shipment_weight"
                value="{{ old('shipment_weight') }}"
                onkeyup="calculateShipmentPrice()">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Length:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_length" id="shipment_length"
                value="{{ old('shipment_length') }}"
                onkeyup="calculateShipmentPrice()">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Height:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_height" id="shipment_height"
                value="{{ old('shipment_height') }}"
                onkeyup="calculateShipmentPrice()">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Width:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="shipment_width" id="shipment_width"
                value="{{ old('shipment_width') }}"
                onkeyup="calculateShipmentPrice()">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Expense:</label>
              <span id="shipment_price"
                class="ml-auto w-2/3 rounded-md p-1 text-black">0</span>
            </div>
            <script type="text/javascript">
              function calculateShipmentPrice() {
                var shipment_weight = document.getElementById('shipment_weight').value;
                var shipment_length = document.getElementById('shipment_length').value;
                var shipment_height = document.getElementById('shipment_height').value;
                var shipment_width = document.getElementById('shipment_width').value;
                var shipment_price = document.getElementById('shipment_price');
                if (shipment_weight == '' || shipment_length == '' || shipment_height ==
                  '' || shipment_width == '') {
                  shipment_price.innerHTML = 0;
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
                  price = volumetric_freight * volumetric_freight_tarrif;
                } else {
                  price = shipment_height * dense_cargo_tarrif;
                }
                shipment_price.innerHTML = price;
              }
            </script>
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
              <input type="hidden" name="shipment_date" id="shipment_date"
                value="{{ date('Y-m-d') }}">
              <span id="shipment_date_display"
                class="ml-auto w-2/3 p-1 text-black">
                {{ date('Y-m-d') }}</span>
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
          class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
          type="submit">Submit</button>
    </div>
    </form>
  </div>
  </div>
</x-app-layout>
