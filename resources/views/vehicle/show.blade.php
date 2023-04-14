<x-app-layout>
<style>
    body{
      color: white;
    }

  </style>

<div class="card">
  <div class="card-header">Vehicles Page</div>
  <div class="card-body">
  
        <div class="card-body">
        <h5 class="card-title">Name : {{ $vehicle->driver_id }}</h5>
        <p class="card-text">Type : {{ $vehicle->type }}</p>
        <p class="card-text">License plate : {{ $vehicle->license_plate }}</p>
        <p class="card-text">Start location : {{ $vehicle->airport_address_id }}</p>
        <h5 class="card-title">End destination : {{ $vehicle->depot_address_id }}</h5>
        <p class="card-text">Status : {{ $vehicle->status }}</p>
  </div>
      
    </hr>
   
  
  </div>
</div>
</x-app-layout>
