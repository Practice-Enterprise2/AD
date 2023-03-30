<!-- TODO: Fix text color. It should either be black or white. -->
<div class="dark:text-gray-500">
  <form wire:submit.prevent="submit">
    <label for="street">Street</label><br>
    <input id="street" name="street" wire:model.defer="address.street" type="text"><br>
    @error('address.street') <p>{{ $message }}</p> @enderror
    <label for="house-number">House number</label><br>
    <input id="house-number" name="house-number" wire:model.defer="address.house_number" type="text"><br>
    @error('address.house-number') <p>{{ $message }}</p> @enderror
    <label for="postal-code">Postal code</label><br>
    <input id="postal-code" name="postal-code" wire:model.defer="address.postal_code" type="text"><br>
    @error('address.postal-code') <p>{{ $message }}</p> @enderror
    <label for="city">City</label><br>
    <input id="city" name="city" wire:model.defer="address.city" type="text"><br>
    @error('address.city') <p>hi</p> @enderror
    <label for="region">Region</label><br>
    <input id="region" name="region" wire:model.defer="address.region" type="text"><br>
    @error('address.region') <p>{{ $message }}</p> @enderror
    <label for="country">Country</label><br>
    <input id="country" name="country" wire:model.defer="address.country" type="text"><br>
    @error('address.country') <p>{{ $message }}</p> @enderror
    <label for="date-time">Date/time</label><br>
    <input id="date-time" name="date-time" wire:model.defer="date_time" type="datetime-local"><br>
    @error('date') <p>{{ $message }}</p> @enderror
    <label for="shipments">Shipment</label>
    <select wire:model.defer="pickup.shipment_id" name="shipments" id="shipments">
      @foreach($shipments_without_pending_pickup as $shipment)
      <option value="{{$shipment->id}}">{{$shipment->name}}</option>
      @endforeach
    </select>
    <div class="mt-4 flex justify-between">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Place
        order</button>
      <div>Fee: €5.00</div>
    </div>
  </form>
</div>
<!-- vim: ft=html
-->
