<div class="flex justify-center">
  <form wire:submit.prevent="save" class="grid gap-4 gap-y-2 grid-cols-1 lg:grid-cols-5 lg:max-w-5xl w-10/12">
    @csrf
    <div class="lg:col-span-5 py-2">
      <label for="shipment">Shipment</label>
      <select name="shipment" wire:model.defer="pickup_shipment_id" class="w-full">
        @foreach($shipments_eligible_for_pickup_creation as $shipment)
        <option value="{{ $shipment->id }}" {{ $pickup_shipment_id !== null && $pickup_shipment_id === $shipment->id ? 'selected="selected"' : '' }}>{{ $shipment->source_address->city }} &rsaquo; {{
          $shipment->destination_address->city }}</option>
        @endforeach
      </select>
      @error('pickup_shipment') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="lg:col-span-4">
      <label for="street">Street</label>
      <input id="street" name="street" class="w-full" wire:model.defer="street" type="text" required>
      @error('street') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="lg:col-span-1">
      <label for="house_number">House number</label>
      <input id="house_number" name="house_number" class="w-full" wire:model.defer="house_number" type="text">
      @error('house_number') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="lg:col-span-2">
      <label for="city">City</label>
      <input id="city" name="city" class="w-full" wire:model.defer="city" type="text">
      @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="lg:col-span-1">
      <label for="postal_code">Postal code</label>
      <input id="postal_code" name="postal_code" class="w-full" wire:model.defer="postal_code" type="text">
      @error('postal_code') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="lg:col-span-2">
      <label for="region">Region</label>
      <input id="region" name="region" class="w-full" wire:model.defer="region" type="text">
      @error('region') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="lg:col-span-5">
      <label for="country">Country</label>
      <input id="country" name="country" class="w-full" wire:model.defer="country" type="text">
      @error('country') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="bg-blue-500 p-2 rounded lg:col-span-5 text-white">Save</button>
  </form>
</div>
<!-- vim: ft=html
-->
