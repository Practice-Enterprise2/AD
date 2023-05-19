{{-- -*-html-*- --}}

<div class="flex justify-center">
  <form wire:submit.prevent="save"
    class="grid w-10/12 grid-cols-1 gap-4 gap-y-2 lg:max-w-5xl lg:grid-cols-5">
    @csrf
    <div class="lg:col-span-4">
      <label for="street">Street</label>
      <input id="street" name="street" class="w-full"
        wire:model.defer="pickup_address.street" type="text" required>
      @error('pickup_address.street')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-1">
      <label for="house_number">House Number</label>
      <input id="house_number" name="house_number" class="w-full"
        wire:model.defer="pickup_address.house_number" type="text" required>
      @error('pickup_address.house_number')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-2">
      <label for="city">City</label>
      <input id="city" name="city" class="w-full"
        wire:model.defer="pickup_address.city" type="text" required>
      @error('pickup_address.city')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-1">
      <label for="postal_code">Postal Code</label>
      <input id="postal_code" name="postal_code" class="w-full"
        wire:model.defer="pickup_address.postal_code" type="text" required>
      @error('pickup_address.postal_code')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-2">
      <label for="region">Region</label>
      <input id="region" name="region" class="w-full"
        wire:model.defer="pickup_address.region" type="text" required>
      @error('pickup_address.region')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-5">
      <label for="country">Country</label>
      <input id="country" name="country" class="w-full"
        wire:model.defer="pickup_address.country" type="text" required>
      @error('pickup_address.country')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <div class="lg:col-span-5">
      <label for="time">Time</label>
      <input id="time" name="time" class="w-full"
        wire:model.defer="pickup.time" type="datetime-local" required>
      @error('pickup.time')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>
    <button
      class="mt-4 rounded bg-gray-500 p-2 text-center text-white lg:col-span-2"
      wire:click="go_back">Back</button>
    <button type="submit"
      class="mt-4 rounded bg-blue-500 p-2 text-white lg:col-span-2 lg:col-start-4">Save</button>
  </form>
</div>
{{-- vim: ft=html
--}}
