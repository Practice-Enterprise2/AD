<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Shipment') }}
        </h2>
    </x-slot>
    <div class="my-4 flex items-center justify-center">
    <div class="mx-auto w-3/5 rounded-md bg-white p-6 shadow-md">
      {{-- Current user --}}
      <h2 class="mb-4 text-sm font-medium text-black">
        Username: {{ auth()->user()->name }}
        Id: {{ auth()->user()->id }}
        Address: {{ auth()->user()->address }}

      </h2>
      <h2 class="mb-4 text-lg font-medium text-black">Update Shipment</h2>
      <form action="{{ route('shipments.update', $shipment->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="sender_id" value="{{ auth()->user()->id }}">

        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700"
            for="receiver_name">Receiver Name</label>
          <input class="w-3/5 rounded-md border border-gray-400 p-2 text-black"
            type="text" id="receiver_name" name="receiver_name" value="{{ $shipment->receiver_name }}">
        </div>
        <div class="mb-4">
          <label class="mb-2 block font-medium text-gray-700"
            for="receiver_email">Receiver Email</label>
          <input class="w-3/5 rounded-md border border-gray-400 p-2 text-black"
            type="receiver_email" id="receiver_email" name="receiver_email" value="{{ $shipment->receiver_email }}">
        </div>
        {{--
                $table->foreignId('source_address_id');
                $table->foreignId('receiver_address_id'); // receiver address obj. will be created after shipment request is done.
                $table->string("receiver_full_name");
            --}}
        <div class="mb-4">
        <div class="mb-2">
        <p class="font-medium text-black text-gray-700 underline">
        Status</p>
          </div></label>
          <div class="flex flex-col">
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="status" value="Awaiting Confirmation"
                @if ($shipment->status == 'Awaiting Confirmation')
                checked
                @endif>
                <span class="ml-2 text-black">Awaiting Confirmation</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="status" value="In Transit"
                @if ($shipment->status == 'In Transit')
                checked
                @endif>
                <span class="ml-2 text-black">In Transit</span>
            </label>    
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="status" value="Out for Delivery"
                @if ($shipment->status == 'Out For Delivery')
                checked
                @endif>
                <span class="ml-2 text-black">Out for Delivery</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="status" value="Awaiting Pickup"
                @if ($shipment->status == 'Awaiting Pickup')
                checked
                @endif>
                <span class="ml-2 text-black">Awaiting Pickup</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="status" value="Delivered"
                @if ($shipment->status == 'Delivered')
                checked
                @endif>
                <span class="ml-2 text-black">Delivered</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="status" value="Cancelled"
                @if ($shipment->status == 'Cancelled')
                checked
                @endif>
                <span class="ml-2 text-black">Cancelled</span>
            </label>
            </div>
        </div>
        <div class="my-10">
          <div class="mb-4">
            <p class="font-medium text-gray-700 underline">Source Address
              Details:</p>
          </div>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Country:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_country" value="{{ $shipment->source_address->country }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_postalcode" value="{{ $shipment->source_address->postal_code }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_city" value="{{ $shipment->source_address->city }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_region" value="{{ $shipment->source_address->region }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_street" value="{{ $shipment->source_address->street }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="source_housenumber" value="{{ $shipment->source_address->house_number }}">
            </div>
          </div>
        </div>

        <div class="my-10">
          <div class="mb-4">
            <p class="font-medium text-black text-gray-700 underline">
              Destination Address Details:</p>
          </div>
          <div class="flex w-1/2 flex-col">
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Country:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_country" value="{{ $shipment->destination_address->country }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">Postal
                Code:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_postalcode" value="{{ $shipment->destination_address->postal_code }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">City:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_city" value="{{ $shipment->destination_address->city }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Region:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_region" value="{{ $shipment->destination_address->region }}">
            </div>
            <div class="mb-2 flex">
              <label
                class="inline-flex w-1/3 items-center text-black">Street:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_street" value="{{ $shipment->destination_address->street }}">
            </div>
            <div class="mb-2 flex">
              <label class="inline-flex w-1/3 items-center text-black">House
                Number:</label>
              <input
                class="ml-auto w-2/3 rounded-md border border-gray-400 p-1 text-black"
                type="text" name="destination_housenumber" value="{{ $shipment->destination_address->house_number }}">
            </div>
          </div>
        </div>
        <div class="mb-4">
            <div class="mb-2">
            <p class="font-medium text-black text-gray-700 underline">
            Handling
            Type:</p>
          </div></label>
          <div class="flex flex-col">
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Standart" 
                @if ($shipment->type == 'Standart')
                checked
                @endif>
              <span class="ml-2 text-black">Standart</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Fragile"
                @if ($shipment->type == 'Fragile')
                checked
                @endif>
              <span class="ml-2 text-black">Fragile</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Hazardous"
                @if ($shipment->type == 'Hazardous')
                checked
                @endif>
              <span class="ml-2 text-black">Hazardous</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="handling_type[]"
                value="Liquid"
                @if ($shipment->type == 'Liquid')
                checked
                @endif>
              <span class="ml-2 text-black">Liquid</span>
            </label>
          </div>
        </div>
        <a href="{{ route('shipments.index') }}" class="rounded-md bg-red-500 px-4 py-2 text-white hover:bg-red-600">Cancel</a>
        <button
          class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600" type="submit">
          Update Shipment</button>
      </form>
    </div>
  </div>
</x-app-layout>