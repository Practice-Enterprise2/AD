<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Order') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <label for="item">Item</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="item" id="item" value="{{ old('item') }}">
                    <br>
                    <label for="quantity">Quantity</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="quantity" id="quantity" value="{{ old('quantity') }}">
                    <br>
                    <label for="purchase_date">Purchase Date</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date') }}">
                    <br>
                    <label for="price">Price</label>
                    <input class = "text-gray-700 rounded-lg px-4" type="text" name="price" id="price" value="{{ old('price') }}">
                    <br>
                    <br>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Add Order</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
       