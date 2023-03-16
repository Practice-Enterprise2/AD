<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Shipment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('shipments.store') }}" method="POST">
                    @csrf
                    <label for="source_address_id">Source Address</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="source_address_id" id="source_address_id" value="{{ old('source_address_id') }}">

                    <label for="destination_address_id">Destination Address</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="destination_address_id" id="destination_address_id" value="{{ old('destination_address_id') }}">

                    <label for="shipment_date">Shipment Date</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="shipment_date" id="shipment_date" value="{{ old('shipment_date') }}">

                    <label for="delivery_date">Delivery Date</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="delivery_date" id="delivery_date" value="{{ old('delivery_date') }}">

                    <label for="status">Status</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="status" id="status" value="{{ old('status') }}">

                    <label for="expense">Expense</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="expense" id="expense" value="{{ old('expense') }}">

                    <label for="weight">Weight</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="weight" id="weight" value="{{ old('weight') }}">

                    <label for="type">Type</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="type" id="type" value="{{ old('type') }}">
                    <br>
                    <br>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Add Shipment</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
       