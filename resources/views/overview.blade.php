@extends('layouts.header')
@section('content')
<h1 class="text-3xl font-bold underline text-center break-after-column">Overview shipments</h1>
</div>
<hr>

<div class="text-center justify-center grid">
<div class="grid gap-4 grid-cols-2 grid-rows-1">
  
  <div class="shadow-lg">
     <p class="text-center font-bold">Graphs</p>
     <a href="./graphs"><img class="object-cover h-48 w-96" src="{{url('/images/graphs.png')}}" style="border: 0;"></a>
  </div>

  <div class="shadow-lg"> 
      <p class="text-center font-bold">Shipments</p>
      <a href="./shipments"><img class="object-cover h-48 w-96" src="{{url('/images/shipments.jpg')}}" style="border: 0;"></a>
  </div>
</div>
@endsection
