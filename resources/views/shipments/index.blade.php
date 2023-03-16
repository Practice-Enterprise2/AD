<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shipments') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('shipments.create') }}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Shipment</button>
                    </a>
                    <br>     
                    <table 
                    class="table-auto"
                    style="border-radius:8px; width:100%; rounded-lg margin: 0 auto; border-collapse: collapse; text-align: center; margin-top: 20px; margin-bottom: 20px; font-size: 20px; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5; color: #333333;"
                    >
                    <thead>
                        <tr style="border-bottom:1pt solid black;" >
                            <th>ShipmentID</th>
                            <th>CustomerID</th>
                            <th>CustomerName</th>
                            <th>SourceAddressID</th>
                            <th>DestinationAddressID</th>
                            <th>ShipmentDate</th>
                            <th>DeliveryDate</th>
                            <th>Status</th>
                            <th>Expense</th>
                            <th>Weight</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipments as $shipment)
                            <tr style="border-bottom:1pt solid black;">
                                <td>{{ $shipment->id }}</td>
                                <td>{{ $shipment->CustomerID }}</td>
                                <td>{{ $shipment->name }}</td>
                                <td>{{ $shipment->source_address_id }}</td>
                                <td>{{ $shipment->destination_address_id }}</td>
                                <td>{{ $shipment->shipment_date }}</td>
                                <td>{{ $shipment->delivery_date }}</td>
                                <td>{{ $shipment->status }}</td>
                                <td>{{ $shipment->expense }}</td>
                                <td>{{ $shipment->weight }}</td>
                                <td>{{ $shipment->type }}</td>
                                <td>
                                    <form action="{{ route('shipments.edit', $shipment->id) }}" method="GET">
                                        @csrf
                                        <button style = "border-radius:10px; width:100% ;color:white; text-decoration: none; background-color: blue; cursor: pointer;" type="submit">Edit</button>
                                    </form>
                                    <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button style = "border-radius:10px; width:100% ;color: white; text-decoration: none; background-color: red; cursor: pointer;" type="submit">Delete</button>
                                    </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
