<html>
<head>
<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<title>Overview per depot</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/airlineoverview.css') }}" >
</head>
<body>
<x-app-layout>
@foreach ($data as $depot)
@if ($depot->id == $id)
<div class="wrap">
    <span>ID: {{$depot->id}}</span>
    <span>Code: {{$depot->code}}</span>
    <span>Address: {{$depot->address}}</span>
    <div id="map"></div>
    <span>size: {{$depot->size}}</span>
    <span>remaining spaces: {{$depot->size - $depot->amountFilled}}</span>
    <div id = "chart" style = "width: 550px; height: 400px; margin: 0 auto"></div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap"></script>
<script>
    $(document).ready(function() {
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
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor)||
                        'black'
                     }
                  }
               }
            };
            var series = [{
               type: 'pie',
               name: 'Space in depot',
               data: [
                  ['Space Left',({!! json_encode($depot->size-$depot->amountFilled)!!})],
                  ['Space filled', {!! json_encode($depot->amountFilled)!!}]
               ]
            }];
            var json = {};   
            json.chart = chart; 
            json.title = title;      
            json.series = series;
            json.plotOptions = plotOptions;
            $('#chart').highcharts(json);  
        });
    
    // The location of Uluru
    var geocoder;
    var map;
    var address = {!! json_encode($depot->address) !!};
    function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: -34.397, lng: 150.644}
    });
    geocoder = new google.maps.Geocoder();
    codeAddress(geocoder, map);
    }

      function codeAddress(geocoder, map) {
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

    
</script>
@endif
@endforeach
</body>

</x-app-layout>
</html>