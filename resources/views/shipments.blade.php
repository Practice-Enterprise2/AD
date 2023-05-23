<x-app-layout>
  <!-- Include needed for JQ -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- using a counter to make unique button id's -->
  <script>
    var i = 0;
    var shipId = 0;
  </script>

  <!-- Modal -->
  <div class="fixed inset-0 z-10 hidden overflow-y-auto" id="cancelModal">
    <div class="flex min-h-screen items-center justify-center p-4 text-center">
      <!-- Modal Background -->
      <div class="fixed inset-0 bg-black opacity-75"></div>
      <!-- Modal Content -->
      <div
        class="relative mx-auto w-full max-w-md rounded bg-white p-6 shadow-lg">
        <h1 class="mb-4 text-2xl font-bold">Confirmation</h1>
        <p class="mb-4">Are you sure you want to cancel the shipment?</p>
        <div class="relative bottom-0 flex w-full justify-center pb-6">
          <a><button
              class="mr-2 rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-600"
              id="confirmCancelButton" onclick="toggleDiv()">
              Yes
            </button></a>
          <button
            class="ml-2 rounded bg-gray-500 px-4 py-2 font-bold text-white hover:bg-gray-600"
            id="cancelCancelButton">
            No
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="flex justify-center">
    <div class="w-full">
      <h1 class="mb-4 text-center text-3xl font-semibold">Shipment Tracking</h1>
      <div class="overflow-x-auto">
        <table
          class="table-sortable mx-auto table-auto border-collapse border border-gray-400">
          <thead>
            <tr class="bg-gray-200">
              <th
                class="border-b border-gray-400 px-6 py-3 text-left text-sm font-bold uppercase text-gray-600"
                id="receiver_name">@sortablelink('receiver_name', 'ShipmentName')</th>
              <th
                class="border-b border-gray-400 px-6 py-3 text-left text-sm font-bold uppercase text-gray-600"
                id="shipment_date">@sortablelink('shipment_date', 'ShipmentDate')</th>
              <th
                class="border-b border-gray-400 px-6 py-3 text-left text-sm font-bold uppercase text-gray-600"
                id="delivery_date">@sortablelink('delivery_date', 'DeliveryDate')</th>
              <th
                class="border-b border-gray-400 px-6 py-3 text-left text-sm font-bold uppercase text-gray-600"
                id="status">@sortablelink('status', 'ShipmentStatus')</th>
              <th
                class="border-b border-gray-400 px-6 py-3 text-left text-sm font-bold uppercase text-gray-600">
              </th>
            </tr>
          </thead>
          <tbody>
            @if (Auth::user()->roles()->first()->name == 'admin' ||
                    Auth::user()->roles()->first()->name == 'employee')
              @foreach ($shipments as $shipment)
                <tr
                  class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100' : '' }}">
                  <td
                    class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                    {{ $shipment->receiver_name }}</td>
                  <td
                    class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                    {{ $shipment->shipment_date }}</td>
                  <td
                    class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                    {{ $shipment->delivery_date }}</td>
                  <td
                    class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                    @if ($shipment->status == 'Exception')
                      <div
                        class="rounded-md border-2 border-gray-900 bg-gray-500 py-2 text-center text-base font-bold text-white">
                        Exception</div>
                    @elseif ($shipment->status == 'Awaiting Confirmation')
                      <div
                        class="rounded-md border-2 border-orange-800 bg-orange-500 py-2 text-center text-base font-bold text-white">
                        Awaiting Confirmation</div>
                    @elseif ($shipment->status == 'Awaiting Pickup')
                      <div
                        class="rounded-md border-2 border-orange-800 bg-orange-500 py-2 text-center text-base font-bold text-white">
                        Awaiting Pickup</div>
                    @elseif ($shipment->status == 'Out For Delivery')
                      <div
                        class="rounded-md border-2 border-blue-900 bg-blue-500 py-2 text-center text-base font-bold text-white">
                        Out For Delivery</div>
                    @elseif ($shipment->status == 'In Transit')
                      <div
                        class="rounded-md border-2 border-lime-900 bg-lime-500 py-2 text-center text-base font-bold text-white">
                        In Transit</div>
                    @elseif ($shipment->status == 'Delivered')
                      <div
                        class="rounded-md border-2 border-green-900 bg-green-500 py-2 text-center text-base font-bold text-white">
                        Delivered</div>
                    @elseif ($shipment->status == 'Held At Location')
                      <div
                        class="rounded-md border-2 border-yellow-900 bg-yellow-500 py-2 text-center text-base font-bold text-white">
                        Held At Location</div>
                    @elseif ($shipment->status == 'Declined')
                      <div
                        class="rounded-md border-2 border-red-900 bg-red-500 py-2 text-center text-base font-bold text-white">
                        Canceled</div>
                    @endif

                  </td>
                  <td
                    class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                    <a
                      href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button
                        type="button"
                        class="rounded-md border-2 border-blue-600 bg-blue-200 px-4 py-2 text-black hover:bg-blue-300">Details</button></a>
                    <button
                      class="rounded-md border-2 border-red-600 bg-red-200 px-4 py-2 text-black hover:bg-red-300"
                      id="cancelButton">Cancel</button>
                    <!--  Script that hides / unhides the modal -->
                    <script>
                      var button = document.getElementById('cancelButton');
                      button.id = 'cancelButton' + i;
                      button.dataset.id = i;
                      cancelButton = button.id;
                      console.log(cancelButton);
                      i++;

                      // cancel modal
                      var modal = document.getElementById('cancelModal');
                      var confirmCancelButton = document.getElementById('confirmCancelButton');
                      var cancelCancelButton = document.getElementById('cancelCancelButton');

                      button.addEventListener('click', function() {
                        console.log("Hello, cancel button!");
                        shipId = "{{ $shipment->id }}";
                        modal.classList.remove('hidden');
                      });
                      confirmCancelButton.addEventListener('click', function() {
                        modal.classList.add('hidden');
                      });
                      cancelCancelButton.addEventListener('click', function() {
                        modal.classList.add('hidden');
                      });
                      okButton.addEventListener('click', function() {});
                    </script>
                  </td>
                </tr>
              @endforeach
            @else
              <!-- Users can only see their own shipment -->
              <!-- -->
              @foreach ($shipments as $shipment)
                @if ($shipment->user_id == Auth::user()->id)
                  <tr
                    class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100' : '' }}">
                    <td
                      class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                      {{ $shipment->receiver_name }}</td>
                    <td
                      class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                      {{ $shipment->shipment_date }}</td>
                    <td
                      class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                      {{ $shipment->delivery_date }}</td>
                    <td
                      class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                      @if ($shipment->status == 'Exception')
                        <div
                          class="rounded-md border-2 border-gray-900 bg-gray-500 py-2 text-center text-base font-bold text-white">
                          Exception</div>
                      @elseif ($shipment->status == 'Awaiting Confirmation')
                        <div
                          class="rounded-md border-2 border-orange-800 bg-orange-500 py-2 text-center text-base font-bold text-white">
                          Awaiting Confirmation</div>
                      @elseif ($shipment->status == 'Awaiting Pickup')
                        <div
                          class="rounded-md border-2 border-orange-800 bg-orange-500 py-2 text-center text-base font-bold text-white">
                          Awaiting Pickup</div>
                      @elseif ($shipment->status == 'Out For Delivery')
                        <div
                          class="rounded-md border-2 border-blue-900 bg-blue-500 py-2 text-center text-base font-bold text-white">
                          Out For Delivery</div>
                      @elseif ($shipment->status == 'In Transit')
                        <div
                          class="rounded-md border-2 border-lime-900 bg-lime-500 py-2 text-center text-base font-bold text-white">
                          In Transit</div>
                      @elseif ($shipment->status == 'Delivered')
                        <div
                          class="rounded-md border-2 border-green-900 bg-green-500 py-2 text-center text-base font-bold text-white">
                          Delivered</div>
                      @elseif ($shipment->status == 'Held At Location')
                        <div
                          class="rounded-md border-2 border-yellow-900 bg-yellow-500 py-2 text-center text-base font-bold text-white">
                          Held At Location</div>
                      @elseif ($shipment->status == 'Declined')
                        <div
                          class="rounded-md border-2 border-red-900 bg-red-500 py-2 text-center text-base font-bold text-white">
                          Canceled</div>
                      @endif

                    </td>
                    <td
                      class="whitespace-no-wrap border-b border-gray-400 px-6 py-4">
                      <a
                        href="{{ route('shipments.showShipments_details', $shipment->id) }}"><button
                          type="button"
                          class="rounded-md border-2 border-blue-600 bg-blue-200 px-4 py-2 text-black hover:bg-blue-300">Details</button></a>
                      <button
                        class="rounded-md border-2 border-red-600 bg-red-200 px-4 py-2 text-black hover:bg-red-300"
                        id="cancelButton">Cancel</button>

                    </td>
                  </tr>
                @endif
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      <div
        class="mx-auto mt-4 w-2/5 rounded-lg border-2 border-blue-600 bg-blue-400 p-3 text-center"
        style="display: none" id="invisibleDiv">
        <h1 class="text-xl">Cancel Info</h1>
        <h2 class="">{{ $error }}
        </h2>
      </div>

      <script>
        function toggleDiv() {
          var div = document.getElementById('invisibleDiv');
          div.style.display = (div.style.display === 'none') ? 'block' : 'none';

          if (div.style.display === 'block') {
            setTimeout(function() {
              div.style.display = 'none';
            }, 5000);
          }
        }
      </script>

    </div>
  </div>

</x-app-layout>
