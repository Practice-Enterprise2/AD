<x-app-layout>

  <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AsGfeENZ_hYN25e91OFGuGbFUm2PHIQrKbvKqg3O1XmJeVxfTgXk8h1p38nbJn1S' async defer></script>
  <script type='text/javascript'>

    function GetMap() {
        var locations = [
        new Microsoft.Maps.Location(51.070169, 4.530014),
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
            center: new Microsoft.Maps.Location(50.848720, 4.359745),
            zoom: 8
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
          </div>
        </div>
        <div id="map"></div>
        <div class="text-center pt-6 bg-white">
        <a href="../shipments"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button></a>
    </div>
    </div>
    
    @endforeach
   
</x-app-layout>