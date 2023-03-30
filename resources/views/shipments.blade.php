<x-app-layout>

    <script type="text/javascript">
        function setLink(elRow) {
        var elLink = document.getElementById('link');
        elLink.href = 'shipments_details/' + elRow.rowIndex;
        }
    </script>
<div class="flex justify-center">
    <div class="w-full max-w-4xl">
        <h1 class="text-3xl font-semibold mb-4 text-center">Shipment Tracking</h1>

        <div class="overflow-x-auto">
            <a id="link">
            <table class="table-auto w-full border-collapse border border-gray-400">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">ShipmentName</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">ShipmentDate</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">DeliveryDate</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase border-b border-gray-400">ShipmentStatus</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($shipments as $shipment)
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100' : '' }}" onclick="setLink(this);">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->shipment_date }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400">{{ $shipment->delivery_date }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-400
                            @if ($shipment->Name == 'On hold')
                            bg-red
                            @elseif ($shipment->Name == 'In progress')
                                bg-orange
                            @elseif ($shipment->Name == 'In Transit')
                                bg-yellow
                            @elseif ($shipment->Name == 'Delivered')
                                bg-lime
                            @elseif ($shipment->Name == 'Completed')
                                bg-green
                            @else
                                bg-white
                            @endif">{{ $shipment->Name }}</td>
                            
                        </tr>
                    @endforeach
                    </a>
                </tbody>
            </table>
        </div>
    </div>
</div>



</x-app-layout>