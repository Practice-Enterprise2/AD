<div>
    <form wire:submit.prevent="submit">
        <label for="street">Street</label><br>
        <input id="street" name="street" wire:model.defer="pickup.street" type="text"><br>
            @error('pickup.street') <p>{{ $message }}</p> @enderror
        <label for="house-number">House number</label><br>
        <input id="house-number" name="house-number" wire:model.defer="pickup.house_number" type="text"><br>
            @error('pickup.house-number') <p>{{ $message }}</p> @enderror
        <label for="postal-code">Postal code</label><br>
        <input id="postal-code" name="postal-code" wire:model.defer="pickup.postal_code" type="text"><br>
            @error('pickup.postal-code') <p>{{ $message }}</p> @enderror
        <label for="city">City</label><br>
        <input id="city" name="city" wire:model.defer="pickup.city" type="text"><br>
            @error('pickup.city') <p>hi</p> @enderror
        <label for="region">Region</label><br>
        <input id="region" name="region" wire:model.defer="pickup.region" type="text"><br>
            @error('pickup.region') <p>{{ $message }}</p> @enderror
        <label for="country">Country</label><br>
        <input id="country" name="country" wire:model.defer="pickup.country" type="text"><br>
            @error('pickup.country') <p>{{ $message }}</p> @enderror
        <label for="date-time">Date/time</label><br>
        <input id="date-time" name="date-time" wire:model.defer="date_time" type="datetime-local"><br>
            @error('date') <p>{{ $message }}</p> @enderror
        <div class="mt-4 flex justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Place order</button>
            <div>Fee: €5.00</div>
        </div>
    </form>
</div>
