<html>
<head>
<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<title>Overview per depot</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/depot.css') }}" >
</head>
<body>
<x-app-layout>
@foreach ($data as $depot)
@if ($depot->id == $id)
<div class="wrap">
    <span>ID: {{$depot->id}}</span>
    <span>Code: {{$depot->code}}</span>
    <span>Address: {{$depot->address}}</span>
    <div>
     <iframe width="500" height="400"src="https://www.bing.com/maps/embed?h=400&w=500&cp=50.999928855859636~289.0001678466797&lvl=11&typ=d&sty=r&src=SHELL&FORM=MBEDV8" scrolling="no">
     </iframe>
</div>
    <span>size: {{$depot->size}}</span>
    <span>remaining spaces: {{$depot->size - $depot->amountFilled}}</span>
    <div id = "chart" style = "width: 550px; height: 400px; margin: 0 auto"></div>
</div>
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
    
    

    
</script>
@endif
@endforeach
</body>

</x-app-layout>
</html>