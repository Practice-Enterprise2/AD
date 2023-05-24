{{-- -*-html-*- --}}

<x-app-layout>

  <div class="my-4 flex items-center justify-center">
    <div class="mx-auto w-3/5 rounded-md bg-white p-6 shadow-md">
      <h2 class="mb-4 text-xl font-medium text-black">Track Shipment</h2>
      <div id="myMap" style="width:100%;height:500px;"
        class="m-2 border border-black"></div>

      <div>
        <p class="text-sm text-black">
          <span
            class="mb-4 inline-block text-lg font-medium text-black underline">
            Shipment with id: </span>
          <span class="text-black">{{ $shipment->id }}</span>
        </p>
        <p class="text-sm text-black">
          <span
            class="mb-4 inline-block text-lg font-medium text-black underline">
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
      </div>
    </div>
  </div>
</x-app-layout>

{{-- BING Maps API --}}
<script type='text/javascript'>
  var myStyle = {
    "settings": {
      "landColor": "#e7e6e5",
      "shadedReliefVisible": false
    },
    "elements": {
      "vegetation": {
        "fillColor": "#c5dea2"
      },
      "water": {
        "fillColor": "#b1bdd6",
        "labelColor": "#ffffff",
        "labelOutlineColor": "#9aa9ca"
      },
      "structure": {
        "fillColor": "#d7d6d5"
      },
      "military": {
        "visible": false
      }
    }
  };

  function GetMap() {
    var map = new Microsoft.Maps.Map('#myMap', {
      credentials: '',
      customMapStyle: myStyle
    });


    var waypoints = {!! json_encode($waypoints_geocodes) !!};

    var polylineCoordinates = [];
    var pushpins = [];


    for (var i = 0; i < waypoints.length; i++) {
      var waypoint = waypoints[i];
      var latitude = waypoint.latitude;
      var longitude = waypoint.longitude;

      var location = new Microsoft.Maps.Location(latitude, longitude);
      polylineCoordinates.push(location);

      if (polylineCoordinates.length > 1 && polylineCoordinates.length <
        waypoints.length) {
        if (waypoint.waypoint_status == "In Transit") {
          var polyline = new Microsoft.Maps.Polyline([polylineCoordinates[i -
            1], polylineCoordinates[i]], {
            strokeColor: 'red',
            strokeThickness: 3
          });
          map.entities.push(polyline);
        } else if (waypoint.waypoint_status == "Out For Delivery") {
          var polyline = new Microsoft.Maps.Polyline([polylineCoordinates[i -
            1], polylineCoordinates[i]], {
            strokeColor: 'yellow',
            strokeThickness: 3
          });
          map.entities.push(polyline);
        } else {
          var polyline = new Microsoft.Maps.Polyline([polylineCoordinates[i -
            1], polylineCoordinates[i]], {
            strokeColor: 'green',
            strokeThickness: 3
          });
          map.entities.push(polyline);
        }
      } else if (polylineCoordinates.length == waypoints.length) {
        if (waypoint.waypoint_status == "Out For Client") {
          var polyline = new Microsoft.Maps.Polyline([polylineCoordinates[i -
            1], polylineCoordinates[i]], {
            strokeColor: 'yellow',
            strokeThickness: 3
          });
          map.entities.push(polyline);
        } else if (waypoint.waypoint_status == "Delivered") {
          var polyline = new Microsoft.Maps.Polyline([polylineCoordinates[i -
            1], polylineCoordinates[i]], {
            strokeColor: 'green',
            strokeThickness: 3
          });
          map.entities.push(polyline);
        } else {
          var polyline = new Microsoft.Maps.Polyline([polylineCoordinates[i -
            1], polylineCoordinates[i]], {
            strokeColor: 'red',
            strokeThickness: 3
          });
          map.entities.push(polyline);
        }
      }

      if (i == 0) {
        var pushpin = new Microsoft.Maps.Pushpin(location, {
          title: `SOURCE ADDRESS ${waypoints[i].waypoint_status}`,
          color: "black"
        });
      } else if (i == (waypoints.length - 1)) {
        var pushpin = new Microsoft.Maps.Pushpin(location, {
          title: "DESTINATION ADDRESS",
          color: "black"
        });
      } else {
        var pushpin = new Microsoft.Maps.Pushpin(location, {
          title: `WAYPOINT STATUS ${waypoints[i].waypoint_status}`,
          color: "blue"
        });
      }

      map.entities.push(pushpin);
    }

    map.setView({
      bounds: Microsoft.Maps.LocationRect.fromLocations(polylineCoordinates)
    });
  }
</script>
<script type='text/javascript' {{-- ADD YOUR API KEY TO ".env" FILE  --}}
  src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key={{ env('BINGMAPS_KEY') }}'
  async defer></script>
