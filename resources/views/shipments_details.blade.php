<x-app-layout>

  <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AsGfeENZ_hYN25e91OFGuGbFUm2PHIQrKbvKqg3O1XmJeVxfTgXk8h1p38nbJn1S' async defer></script>
  <script type='text/javascript'>

    function GetMap() {
      
        var locations = [
        new Microsoft.Maps.Location(50.853752, 4.380796),
        new Microsoft.Maps.Location(51.075579, 4.733860),
        new Microsoft.Maps.Location(51.160911, 4.666846),
        // add more locations here
      ];

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
        map.entities.push(new Microsoft.Maps.Infobox(e.target.getLocation(), {
            description: e.target.metadata.description
        }));
    });

    

    map.entities.push(pushpin);
}
        map.entities.push(polyline);
    }
 </script>  
  @foreach($shipments as $shipment)
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white h-screen">
        <h1 class="text-2xl font-semibold mb-4">{{ __('Shipment Tracking') }}</h1>
        <div class="flex justify-between mb-8">
          <div>
            <p class="text-sm font-medium text-gray-500">{{ __('Shipment Date') }}</p>
            <p class="text-lg font-semibold">{{ $shipment->shipment_date }}</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">{{ __('Estimated Delivery') }}</p>
            <p class="text-lg font-semibold">{{ $shipment->delivery_date }}</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">{{ __('Shipment Weight') }}</p>
            <p class="text-lg font-semibold">{{ $shipment->weight }} kg</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">{{ __('Status') }}</p>
            <p class="text-lg font-semibold {{ $shipment->status === 'Delivered' ? 'text-green-600' : 'text-orange-600' }}">{{ $shipment->status }}</p>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
          <div class="px-6 py-4">
            <h2 class="text-xl font-semibold mb-4">{{ __('Sender Information') }}</h2>
            <p class="text-gray-700 mb-2"><span class="font-medium">{{ __('Name') }}:</span> {{ $shipment->receiver_name }}</p>
            <p class="text-gray-700 mb-2"><span class="font-medium">{{ __('Destination addres') }}:</span> {{$shipment->street}} {{$shipment->house_number}}, {{$shipment->city}} {{$shipment->postal_code}} {{$shipment->country}}</p>
          </div>
        </div>

      <!-- Progress bar of shipment  -->
      <div class="bg-darkTheme_gray h-fit rounded-lgs w-full p-6 my-4">        
                <div class="flex flex-wrap -mx-4">                  
                  <div class="w-full md:w-2/2 px-4">
                      <div class="bg-white rounded-lg shadow-lg">
                          <div class="px-6 py-4">
                              <div class="font-bold text-xl mb-2">Status of package</div>
                          
                              {{-- Status of the Package delivery process --}}
                              <div class="h-full flex justify-between relative">
                                <div class="h-2.5 rounded-full bg-black dark:border-b-gray-900 absolute bottom-0 left-0 right-0 mb-3"></div> <!-- Gray Line -->
                                
                                @if ($shipment->status == 'Canceled' || $shipment->status == 'Exception')
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-red-500 dark:bg-red-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held at location</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Out For Delivery</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif
                                                                
                                @if ($shipment->status == 'Awaiting Pickup' || $shipment->status == 'Awaiting Confirmation')
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-orange-500 dark:bg-orange-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held at location</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Out For Delivery</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif
                                @if ($shipment->status == 'In Transit')
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held at location</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-lime-500 dark:bg-lime-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Out For Delivery</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif
                                                                
                                @if ($shipment->status == 'Held At Location')
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held at location</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-yellow-500 dark:bg-yellow-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Out For Delivery</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif

                                @if ($shipment->status  == 'Delivered')
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held at location</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Out For Delivery</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-green-500 dark:bg-green-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif     
                                @if ($shipment->status  == 'Out For Delivery')
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Cancelled / Exception</div>                                
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-500 rounded-full"></div> <!-- Status 1: Green -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Awaiting Confirmation / Pickup</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 2: Yellow -->
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Held at location</div>
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 4: Purple -->                                
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>In Transit</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Out For Delivery</div>                              
                                    <div class="w-8 h-8 flex items-center justify-center bg-blue-500 dark:bg-blue-900 rounded-full"></div> <!-- Status 3: Blue -->                                  
                                </div>
                                <div class="relative flex flex-col items-center justify-center text-center">
                                  <div>Delivered</div>                                  
                                    <div class="w-8 h-8 flex items-center justify-center bg-gray-500 dark:bg-gray-900 rounded-full"></div> <!-- Status 5: Red -->                                  
                                </div>
                                @endif                                                       
                              </div>                                                   
                          </div>
                      </div>
                  </div>  
              </div> 
              
              <div id="map" style="position:relative;height:800px;"></div>
                <div class="text-center pt-6">
                <a href="../shipments"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button></a>
              </div>
            </div>

        
    </div>
    
    @endforeach
   
</x-app-layout>