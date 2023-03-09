<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('orders.update', $order->OrderID) }}" method="POST">

                        @csrf
                        @method('PATCH')
                        <label for="Item">Item</label>
                        <input class = "text-gray-700 rounded-lg px-4" type="text" name="Item" id="Item" value="{{ $order->Item }}">
                        <br>
                        <label for="Quantity">Quantity</label>
                        <input class = "text-gray-700 rounded-lg px-4" type="text" name="Quantity" id="Quantity" value="{{ $order->Quantity }}">
                        <br>
                        <label for="PurchaseDate">PurchaseDate</label>
                        <input class = "text-gray-700 rounded-lg px-4" type="text" name="PurchaseDate" id="PurchaseDate" value="{{ $order->PurchaseDate }}">
                        <br>
                        <label for="Price">Price</label>
                        <input class = "text-gray-700 rounded-lg px-4" type="text" name="Price" id="Price" value="{{ $order->Price }}">
                        <br>
                        <br>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>