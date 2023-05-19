{{-- -*-html-*- --}}

<div class="flex justify-center">
  <form wire:submit.prevent="save"
    class="grid w-10/12 grid-cols-1 gap-4 gap-y-2 lg:max-w-5xl lg:grid-cols-5">
    @csrf
    <div class="py-2 lg:col-span-5">
      <label for="shipment">Shipment</label>
      <select name="shipment" wire:model.defer="pickup_shipment_id"
        class="w-full text-gray-950">
        @foreach ($shipments_eligible_for_pickup_creation as $shipment)
          <option value="{{ $shipment->id }}"
            {{ $pickup_shipment_id !== null && $pickup_shipment_id === $shipment->id
                ? 'selected="selected"'
                : '' }}>
            {{ $shipment->source_address->city }} &rsaquo;
            {{ $shipment->destination_address->city }}</option>
        @endforeach
      </select>
      @error('pickup_shipment')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-4">
      <label for="street">Street</label>
      <input id="street" name="street" class="w-full text-gray-950"
        wire:model.defer="street" type="text" required>
      @error('street')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-1">
      <label for="house_number">House number</label>
      <input id="house_number" name="house_number" class="w-full text-gray-950"
        wire:model.defer="house_number" type="text" required>
      @error('house_number')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-2">
      <label for="city">City</label>
      <input id="city" name="city" class="w-full text-gray-950"
        wire:model.defer="city" type="text" required>
      @error('city')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-1">
      <label for="postal_code">Postal code</label>
      <input id="postal_code" name="postal_code" class="w-full text-gray-950"
        wire:model.defer="postal_code" type="text" required>
      @error('postal_code')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-2">
      <label for="region">Region</label>
      <input id="region" name="region" class="w-full text-gray-950"
        wire:model.defer="region" type="text" required>
      @error('region')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-5">
      <label for="country">Country</label>
      <input id="country" name="country" class="w-full text-gray-950"
        wire:model.defer="country" type="text" required>
      @error('country')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-5">
      <label for="time">Time</label>
      <input id="time" name="time" class="w-full text-gray-950"
        wire:model.defer="time" type="datetime-local" required>
      @error('time')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <button type="submit"
      class="rounded bg-blue-500 p-2 text-white lg:col-span-5">Save</button>
  </form>
</div>
{{-- vim: ft=html
--}}
