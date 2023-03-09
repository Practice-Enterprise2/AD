<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('orders.create') }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Order</button>
                    </a>
                    <br>     
                    <table 
                    class="table-auto"
                    style="border-radius:8px; width:100%; rounded-lg margin: 0 auto; border-collapse: collapse; text-align: center; margin-top: 20px; margin-bottom: 20px; font-size: 20px; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5; color: #333333;"
                    >
                    <thead>
                        <tr style="border-bottom:1pt solid black;" >
                            <th>OrderID</th>
                            <th>CustomerID</th>
                            <th>CustomerName</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>PurchaseDate</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr style="border-bottom:1pt solid black;">
                                <td>{{ $order->OrderID }}</td>
                                <td>{{ $order->CustomerID }}</td>
                                <td>{{ $order->CustomerName }}</td>
                                <td>{{ $order->Item }}</td>
                                <td>{{ $order->Quantity }}</td>
                                <td>{{ $order->PurchaseDate }}</td>
                                <td>{{ $order->Price }}</td>
                                <td>
                                    <form action="{{ route('orders.edit', $order->OrderID) }}" method="GET">
                                        @csrf
                                        <button style = "border-radius:10px; width:100% ;color:white; text-decoration: none; background-color: blue; cursor: pointer;" type="submit">Edit</button>
                                    </form>
                                    <form action="{{ route('orders.destroy', $order->OrderID) }}" method="POST">
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
