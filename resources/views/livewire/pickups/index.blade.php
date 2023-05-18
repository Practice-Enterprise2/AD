{{-- -*-html-*- --}}

<div class="flex justify-center">
  <table>
    <tr class="border-2 border-black dark:border-white">
      <th class="border-2 border-black dark:border-white">Shipment Destination
      </th>
      <th class="border-2 border-black dark:border-white">Date/time</th>
      <th class="border-2 border-black dark:border-white">Street</th>
      <th class="border-2 border-black dark:border-white">Number</th>
      <th class="border-2 border-black dark:border-white">Postal Code</th>
      <th class="border-2 border-black dark:border-white">City</th>
      <th class="border-2 border-black dark:border-white">Region</th>
      <th class="border-2 border-black dark:border-white">Country</th>
      <th class="border-2 border-black dark:border-white">Status</th>
      <th class="border-2 border-black dark:border-white">Edit</th>
      <th class="border-2 border-black dark:border-white">Cancel</th>
    </tr>
    @foreach ($pickups as $pickup)
      <tr class="h-full border-2 border-black dark:border-white">
        <td class="border-2 border-black dark:border-white">
          {{ $pickup->shipment->destination_address->country }},{{ $pickup->shipment->destination_address->city }}
        </td>
        <td class="border-2 border-black dark:border-white">{{ $pickup->time }}
        </td>
        <td class="border-2 border-black dark:border-white">
          {{ $pickup->address->street }}</td>
        <td class="border-2 border-black dark:border-white">
          {{ $pickup->address->house_number }}</td>
        <td class="border-2 border-black dark:border-white">
          {{ $pickup->address->postal_code }}</td>
        <td class="border-2 border-black dark:border-white">
          {{ $pickup->address->city }}</td>
        <td class="border-2 border-black dark:border-white">
          {{ $pickup->address->region }}</td>
        <td class="border-2 border-black dark:border-white">
          {{ $pickup->address->country }}</td>
        <td class="border-2 border-black dark:border-white">
          {{ $pickup->status }}</td>
        <td><a
            href="{{ route('pickups.edit', ['pickup' => $pickup->id]) }}">Edit</a>
        </td>
        <td class="h-full border-2 border-black dark:border-white"><button
            class="h-full w-full bg-red-500"
            wire:click="cancel_pickup({{ $pickup->id }})">Cancel</button>
        </td>
      </tr>
    @endforeach
  </table>
</div>
