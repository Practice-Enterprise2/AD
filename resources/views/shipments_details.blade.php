<x-app-layout>

  <script type='text/javascript'
    src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AsGfeENZ_hYN25e91OFGuGbFUm2PHIQrKbvKqg3O1XmJeVxfTgXk8h1p38nbJn1S'
    async defer></script>
  <script type='text/javascript'>
    var collection = @json($waypointsCollection);
    var latitude = [];
    var longitude = [];
    var locations = [];
    var status = "";
    var polyline;

    function GetMap() {

      for (var i = 0; i < collection.length; i++) {
        latitude = parseFloat(Object.values(collection[i]['latitude'])[0]);
        longitude = parseFloat(Object.values(collection[i]['longitude'])[0]);
        locations[i] = new Microsoft.Maps.Location(latitude, longitude);
      }

      var polyline = new Microsoft.Maps.Polyline(locations, {
        strokeColor: 'red',
        strokeThickness: 3
      });



      var map = new Microsoft.Maps.Map('#map', {
        credentials: 'AsGfeENZ_hYN25e91OFGuGbFUm2PHIQrKbvKqg3O1XmJeVxfTgXk8h1p38nbJn1S',
        center: locations[0],
        zoom: 9
      });
      for (var i = 0; i < locations.length; i++) {
        var pushpin = new Microsoft.Maps.Pushpin(locations[i], {
          title: 'Location ' + i
        });

        pushpin.metadata = {
          description: 'This is location ' + i
        };

        Microsoft.Maps.Events.addHandler(pushpin, 'mouseover', function(e) {
          map.entities.push(new Microsoft.Maps.Infobox(e.target
            .getLocation(), {
              description: e.target.metadata.description
            }));
        });



        map.entities.push(pushpin);
      }
      map.entities.push(polyline);
    }
  </script>
  @foreach ($shipments as $shipment)
    <div class="mx-auto h-screen max-w-6xl bg-white px-4 py-8 sm:px-6 lg:px-8">
      <h1 class="mb-4 text-2xl font-semibold">{{ __('Shipment Tracking') }}</h1>
      <div class="mb-8 flex justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500">{{ __('Shipment Date') }}
          </p>
          <p class="text-lg font-semibold">{{ $shipment->shipment_date }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">
            {{ __('Estimated Delivery') }}</p>
          <p class="text-lg font-semibold">{{ $shipment->delivery_date }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">
            {{ __('Shipment Weight') }}</p>
          <p class="text-lg font-semibold">{{ $shipment->weight }} kg</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">{{ __('Status') }}</p>
          <p
            class="{{ $shipment->status === 'Delivered' ? 'text-green-600' : 'text-orange-600' }} text-lg font-semibold">
            {{ $shipment->status }}</p>
        </div>
      </div>
      <div class="overflow-hidden rounded-lg bg-white shadow-lg">
        <div class="px-6 py-4">
          <h2 class="mb-4 text-xl font-semibold">{{ __('Sender Information') }}
          </h2>
          <p class="mb-2 text-gray-700"><span
              class="font-medium">{{ __('Name') }}:</span>
            {{ $shipment->receiver_name }}</p>
          <p class="mb-2 text-gray-700"><span
              class="font-medium">{{ __('Destination addres') }}:</span>
            {{ $shipment->street }} {{ $shipment->house_number }},
            {{ $shipment->city }} {{ $shipment->postal_code }}
            {{ $shipment->country }}</p>
        </div>
      </div>

      <!-- Progress bar of shipment  -->
      <div class="bg-darkTheme_gray rounded-lgs my-4 h-fit w-full p-6">
        <div class="-mx-4 flex flex-wrap">
          <div class="md:w-2/2 w-full px-4">
            <div class="rounded-lg bg-white shadow-lg">
              <div class="px-6 py-4">
                <div class="mb-2 text-xl font-bold">Status of package</div>

                {{-- Status of the Package delivery process --}}
                <div class="relative flex h-full justify-between">
                  <div
                    class="absolute bottom-0 left-0 right-0 mb-3 h-2.5 rounded-full bg-black dark:border-b-gray-900">
                  </div> <!-- Gray Line -->

                  @if ($shipment->status == 'Declined' || $shipment->status == 'Exception')
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Canceled / Exception</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-red-500 dark:bg-red-500">
                      </div> <!-- Status 1: Green -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Awaiting Confirmation / Pickup</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 2: Yellow -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Held at location</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 4: Purple -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>In Transit</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Out For Delivery</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Delivered</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 5: Red -->
                    </div>
                  @endif

                  @if (
                      $shipment->status == 'Awaiting Pickup' ||
                          $shipment->status == 'Awaiting Confirmation')
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Cancelled / Exception</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-500">
                      </div> <!-- Status 1: Green -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Awaiting Confirmation / Pickup</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-orange-500 dark:bg-orange-900">
                      </div> <!-- Status 2: Yellow -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Held at location</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 4: Purple -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>In Transit</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Out For Delivery</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Delivered</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 5: Red -->
                    </div>
                  @endif
                  @if ($shipment->status == 'In Transit')
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Canceled / Exception</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-500">
                      </div> <!-- Status 1: Green -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Awaiting Confirmation / Pickup</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 2: Yellow -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Held at location</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 4: Purple -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>In Transit</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-lime-500 dark:bg-lime-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Out For Delivery</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Delivered</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 5: Red -->
                    </div>
                  @endif

                  @if ($shipment->status == 'Held At Location')
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Cancelled / Exception</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-500">
                      </div> <!-- Status 1: Green -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Awaiting Confirmation / Pickup</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 2: Yellow -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Held at location</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-yellow-500 dark:bg-yellow-900">
                      </div> <!-- Status 4: Purple -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>In Transit</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Out For Delivery</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Delivered</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 5: Red -->
                    </div>
                  @endif

                  @if ($shipment->status == 'Delivered')
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Cancelled / Exception</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-500">
                      </div> <!-- Status 1: Green -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Awaiting Confirmation / Pickup</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 2: Yellow -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Held at location</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 4: Purple -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>In Transit</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Out For Delivery</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Delivered</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-green-500 dark:bg-green-900">
                      </div> <!-- Status 5: Red -->
                    </div>
                  @endif
                  @if ($shipment->status == 'Out For Delivery')
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Cancelled / Exception</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-500">
                      </div> <!-- Status 1: Green -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Awaiting Confirmation / Pickup</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 2: Yellow -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Held at location</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 4: Purple -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>In Transit</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Out For Delivery</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-500 dark:bg-blue-900">
                      </div> <!-- Status 3: Blue -->
                    </div>
                    <div
                      class="relative flex flex-col items-center justify-center text-center">
                      <div>Delivered</div>
                      <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-500 dark:bg-gray-900">
                      </div> <!-- Status 5: Red -->
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="map" style="position:relative;height:800px;"></div>
        <div class="pt-6 text-center">
          <a href="../shipments"><button type="button"
              class="mb-2 mr-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</button></a>
        </div>
      </div>

    </div>
  @endforeach

</x-app-layout>
