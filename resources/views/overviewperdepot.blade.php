<html>

<head>
  <script src="{{asset('js/jquery.js')}}"></script>
  <title>Overview per depot</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}">
</head>

<body>
  <x-app-layout>
    @foreach ($data as $depot)
      @if ($depot->id == $id)
        @php
          $address = (string) $depot->street . (string) ' ' . (string) $depot->house_number . (string) ' ' . (string) $depot->postal_code . (string) ' ' . (string) $depot->city . (string) ' ' . (string) $depot->region . (string) ' ' . (string) $depot->country;
        @endphp
        <div class="wrap">
          <span>ID: {{ $depot->id }}</span>
          <span>Code: {{ $depot->code }}</span>
          <span>Address: {{ $address }}</span>
          <div id='myMap'></div>
          <span>size: {{ $depot->size }}</span>
          <span>remaining spaces:
            {{ $depot->size - $depot->amountFilled }}</span>
          <div id="chart" style="width: 550px; height: 400px; margin: 0 auto">
          </div>
        </div>
        <script>
          jQuery(document).ready(function($) {
            
            var chart = {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false
            };
            var title = {
              text: 'Space in depot'
            };
            var plotOptions = {
              pie: {
                allowPointSelect: true,
                cursor: 'pointer',

                dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.y:.0f} ',
                  style: {
                    color: (Highcharts.theme && Highcharts.theme
                        .contrastTextColor) ||
                      'black'
                  }
                }
              }
            };
            var series = [{
              type: 'pie',
              name: 'Space in depot',
              data: [
                ['Space Left', ({!! json_encode($depot->size - $depot->amountFilled) !!})],
                ['Space filled', {!! json_encode($depot->amountFilled) !!}]
              ]
            }];
            var json = {};
            json.chart = chart;
            json.title = title;
            json.series = series;
            json.plotOptions = plotOptions;
            $('#chart').highcharts(json);
          });

          function loadMapScenario() {
            var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
              /* No need to set credentials if already passed in URL */
              center: new Microsoft.Maps.Location(47.624527, -122.355255),
              zoom: 8
            });
            Microsoft.Maps.loadModule('Microsoft.Maps.Search', function() {
              var searchManager = new Microsoft.Maps.Search.SearchManager(map);
              var requestOptions = {
                bounds: map.getBounds(),
                where: {!! json_encode($address) !!},
                callback: function(answer, userData) {
                  map.setView({
                    bounds: answer.results[0].bestView
                  });
                  map.entities.push(new Microsoft.Maps.Pushpin(answer.results[0]
                    .location));
                }
              };
              searchManager.geocode(requestOptions);
            });
          }
        </script>
        <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=Ar73l2OORU8TsJzUcyYXHU-_VUNJeHiKKQ8v2hsKpvVUf795R7bEoKfBgAfF_Rsn&callback=loadMapScenario' async defer></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
      @endif
    @endforeach
</body>

</x-app-layout>

</html>
