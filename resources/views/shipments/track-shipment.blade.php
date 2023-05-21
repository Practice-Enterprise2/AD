{{-- -*-html-*- --}}

<x-app-layout>

  <div class="my-4 flex items-center justify-center">
    <div class="mx-auto w-3/5 rounded-md bg-white p-6 shadow-md">
      {{-- Current user --}}
      <h2 class="mb-4 text-sm font-medium">
        Username: {{ auth()->user()->name }}
        Id: {{ auth()->user()->id }}
        Address: {{ auth()->user()->address }}

      </h2>
      <h2 class="mb-4 text-lg font-medium">Track Shipment</h2>
      <div id="myMap" style="width:100%;height:500px;"
        class="m-2 border border-black"></div>

      <p>{{ $shipment }}</p>
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


      var pushpin = new Microsoft.Maps.Pushpin(location, {
        title: waypoint.waypoint.name,
        description: waypoint.waypoint.description
      });

      pushpins.push(pushpin);
      map.entities.push(pushpin);
    }

    map.setView({
      bounds: Microsoft.Maps.LocationRect.fromLocations(polylineCoordinates)
    });
  }
</script>
<script type='text/javascript'
  src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key={API_KEY}'
  async defer></script>
