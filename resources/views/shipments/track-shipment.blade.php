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
      <div id="myMap" style="width:60%;height:300px;"
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


    // NEED DYNAMIC Locations
    var leuven = new Microsoft.Maps.Location(50.8798, 4.7005); // Leuven
    var mechelen = new Microsoft.Maps.Location(51.0259, 4.4775); // Mechelen
    var brussels = new Microsoft.Maps.Location(50.8503, 4.3517); // Brussels
    var istanbul = new Microsoft.Maps.Location(41.0082, 28.9784); // Istanbul


    // ---- SINGLE-COLOR-RED ---- //
    // var line = new Microsoft.Maps.Polyline([leuven, mechelen, brussels, istanbul], {
    //     strokeColor: 'red',
    //     strokeThickness: 3
    // });
    // map.entities.push(line);


    // PUSHPINS ADJUST LATER ON
    // var pushpinLeuven = new Microsoft.Maps.Pushpin(leuven, {
    //     title: "Leuven",
    //     description: "Leuven is a historic university city located in Flemish Brabant, Belgium."
    // });
    // var pushpinMechelen = new Microsoft.Maps.Pushpin(mechelen, {
    //     title: "Mechelen",
    //     description: "Mechelen is a city in the province of Antwerp, Belgium with a rich cultural heritage."
    // });
    // var pushpinBrussels = new Microsoft.Maps.Pushpin(brussels, {
    //     title: "Brussels",
    //     description: "Brussels is the capital city of Belgium and the European Union, known for its stunning architecture and delicious chocolate."
    // });
    // var pushpinIstanbul = new Microsoft.Maps.Pushpin(istanbul, {
    //     title: "Istanbul",
    //     description: "Istanbul is a transcontinental city in Turkey, straddling Europe and Asia, and rich in history and culture."
    // });


    // ---- MULTIPLE COLORS ---- //
    var polyline1 = new Microsoft.Maps.Polyline([leuven, mechelen], {
      strokeColor: 'green',
      strokeThickness: 3
    });

    var polyline2 = new Microsoft.Maps.Polyline([mechelen, brussels], {
      strokeColor: 'blue',
      strokeThickness: 3
    });

    var polyline3 = new Microsoft.Maps.Polyline([brussels, istanbul], {
      strokeColor: 'red',
      strokeThickness: 3
    });
    map.entities.push(polyline1);
    map.entities.push(polyline2);
    map.entities.push(polyline3);
    map.entities.push(pushpinLeuven);
    map.entities.push(pushpinMechelen);
    map.entities.push(pushpinBrussels);
    map.entities.push(pushpinIstanbul);



    // PUSHPIN EVENTS EXAMPLE //
    // Microsoft.Maps.Events.addHandler(pushpinLeuven, 'click', function () { highlight('pushpinClick', pushpinLeuven); });
    // Microsoft.Maps.Events.addHandler(pushpinMechelen, 'click', function () { highlight('pushpinClick', pushpinMechelen); });
    // Microsoft.Maps.Events.addHandler(pushpinBrussels, 'click', function () { highlight('pushpinClick', pushpinBrussels); });
    // Microsoft.Maps.Events.addHandler(pushpinIstanbul, 'click', function () { highlight('pushpinClick', pushpinIstanbul); });

    // VIEW RANGE
    map.setView({
      bounds: Microsoft.Maps.LocationRect.fromLocations([leuven, mechelen,
        brussels, istanbul
      ])
    });
  }

  // function highlight(id, pushpin) {
  //     //Highlight the mouse event div to indicate that the event has fired.

  //     document.getElementById(id).style.background = 'LightGreen';
  //     alert(`${pushpin.getTitle()} h'been clicked!`);
  //     //Remove the highlighting after a second.
  //     setTimeout(function () { document.getElementById(id).style.background = 'white'; }, 1000);
  // }
</script>
<script type='text/javascript'
  src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=[YOUR_BING_MAPS_KEY]'
  async defer></script>
