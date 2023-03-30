<div>
    <table class="dark:text-white">
        <tr class="border-2 border-black">
            <th class="border-2 border-black">Date/time</th>
            <th class="border-2 border-black">Street</th>
            <th class="border-2 border-black">Number</th>
            <th class="border-2 border-black">Postal Code</th>
            <th class="border-2 border-black">City</th>
            <th class="border-2 border-black">Region</th>
            <th class="border-2 border-black">Country</th>
            <th class="border-2 border-black">Status</th>
            <th class="border-2 border-black">Cancel</th>
        </tr>
        @foreach($pickups as $pickup)
        <tr class="border-2 border-black">
            <td class="border-2 border-black">{{ $pickup->time }}</td>
            <td class="border-2 border-black">{{ $pickup->address->street }}</td>
            <td class="border-2 border-black">{{ $pickup->address->house_number }}</td>
            <td class="border-2 border-black">{{ $pickup->address->postal_code }}</td>
            <td class="border-2 border-black">{{ $pickup->address->city }}</td>
            <td class="border-2 border-black">{{ $pickup->address->region }}</td>
            <td class="border-2 border-black">{{ $pickup->address->country }}</td>
            <td class="border-2 border-black">{{ $pickup->status }}</td>
            <td class="border-2 border-black"><button wire:click="cancel_pickup({{ $pickup->id }})">Cancel</button></td>
        </tr>
        @endforeach
    </table>
</div>
