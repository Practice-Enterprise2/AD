<x-app-layout>

<div class="card">
  <div class="card-header">Vehicles Page</div>
  <div class="card-body">
  
        <div class="card-body">
        <h5 class="card-title">Name : {{ $vehicle->name }}</h5>
        <p class="card-text">Type : {{ $vehicle->type }}</p>
        <p class="card-text">License plate : {{ $vehicle->license_plate }}</p>
        <p class="card-text">Start location : {{ $vehicle->start_location }}</p>
        <h5 class="card-title">End destination : {{ $vehicle->end_location }}</h5>
        <p class="card-text">Status : {{ $vehicle->status }}</p>
  </div>
      
    </hr>
  
  </div>
</div>
</x-app-layout>
