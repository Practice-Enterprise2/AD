<x-app-layout>

<div class="card">
  <div class="card-header">Vehicle Create Page</div>
  <div class="card-body">
      
      <form action="{{ url('vehicle') }}" method="post">
        {!! csrf_field() !!}
        <label>Name</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>Type</label></br>
        <input type ="radio" name="type" id="type"class="form-control"></br>
            <input type="radio" id="SemiTrailer" name="type" value="Semi Trailer">
            <label for="SemiTrailer">Semi Trailer</label><br>
            <input type="radio" id="Flatbed" name="type" value="Flatbed">
            <label for="Flatbed">Flatbed</label><br>
            <input type="radio" id="StepDeck" name="type" value="Step Deck">
            <label for="StepDeck">Step Deck</label><br>
            <input type="radio" id="DryVan" name="type" value="Dry Van">
            <label for="DryVan">Dry Van</label><br>
            <input type="radio" id="Reefer" name="type" value="Reefer">
            <label for="Reefer">Reefer</label><br>
            <input type="radio" id="BoxTruck" name="type" value="Box Truck">
            <label for="Box Truck">Box Truck</label><br>
            <input type="radio" id="Tanker" name="type" value="Tanker">
            <label for="Tanker">Tanker</label><br>
        <label>license plate</label></br>
        <input type="text" name="license_plate" id="license_plate" class="form-control"></br>
        <label>Start location</label></br>
        <input type="text" name="start_location" id="start_location" class="form-control"></br>
        <label>End destination</label></br>
        <input type="text" name="end_location" id="end_location" class="form-control"></br>
        <label>Status</label></br>
        <input type="radio" name="status" id="status"class="form-control"></br> <!--'standby', 'on route', 'maintenance', 'unavailable'-->
            <input type="radio" id="standby" name="status" value="standby">
            <label for="standby">standby</label><br>
            <input type="radio" id="on route" name="status" value="on route">
            <label for="on route">on route</label><br>
            <input type="radio" id="maintenance" name="status" value="maintenance">
            <label for="maintenance">maintenance</label><br>
            <input type="radio" id="unavailable" name="status" value="unavailable">
            <label for="unavailable">unavailable</label><br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
  
  </div>
</div>
</x-app-layout>
