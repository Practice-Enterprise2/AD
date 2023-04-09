<x-app-layout>

<div class="flex items-center justify-center my-4">
    <div class="w-3/5 mx-auto bg-white p-6 rounded-md shadow-md">
        {{-- Current user --}}
        <h2 class="text-sm text-black font-medium mb-4">
            Username: {{ auth()->user()->name }}
            Id: {{ auth()->user()->id }}
            Address: {{ auth()->user()->address }}

        </h2>
        <h2 class="text-lg text-black font-medium mb-4">Request Shipment</h2>
        <form action="{{ route('shipments.store') }}" method="POST">
            @csrf
            <input type="hidden"  name="sender_id" value="{{ auth()->user()->id }}">
            <input type="hidden"  name="sender_address" value="Hello!!">


            {{-- User address attributes needs to be fetched here
            <input type="hidden"  name="sender_address_id" value="{{ auth()->user()->adress_id }}"> --}}

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="receiver_name">Receiver Name</label>
                <input class="border border-gray-400 p-2 w-3/5 rounded-md text-black" type="text" id="receiver_name" name="receiver_name">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="receiver_email">Receiver Email</label>
                <input class="border border-gray-400 p-2 w-3/5 rounded-md text-black" type="receiver_email" id="receiver_email" name="receiver_email">
            </div>
            {{--
                $table->foreignId('source_address_id');
                $table->foreignId('receiver_address_id'); // receiver address obj. will be created after shipment request is done.
                $table->string("receiver_full_name");
            --}}
            <div class="my-10">
                <div class="mb-4">
                    <p class="font-medium underline text-gray-700">Source Address Details:</p>
                </div>
                <div class="flex flex-col w-1/2">
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">Country:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="source_country">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">Postal Code:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="source_postalcode">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">City:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="source_city">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">Region:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="source_region">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">Street:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="source_street">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">House Number:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="source_housenumber">
                    </div>
                </div>
            </div>


            <div class="my-10">
                <div class="mb-4">
                    <p class="font-medium underline text-gray-700 text-black">Destination Address Details:</p>
                </div>
                <div class="flex flex-col w-1/2">
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">Country:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="destination_country">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">Postal Code:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="destination_postalcode">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">City:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="destination_city">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">Region:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="destination_region">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">Street:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="destination_street">
                    </div>
                    <div class="flex mb-2">
                        <label class="w-1/3 inline-flex items-center text-black">House Number:</label>
                        <input class="border border-gray-400 p-1 w-2/3 rounded-md ml-auto text-black" type="text" name="destination_housenumber">
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2 text-black">Handling Type</label>
                <div class="flex flex-col">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="handling_type[]" value="Standart">
                        <span class="ml-2 text-black">Standart</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="handling_type[]" value="Fragile">
                        <span class="ml-2 text-black">Fragile</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="handling_type[]" value="Hazardous">
                        <span class="ml-2 text-black">Hazardous</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="handling_type[]" value="Liquid">
                        <span class="ml-2 text-black">Liquid</span>
                    </label>
                </div>
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" type="submit">Submit</button>
        </form>
    </div>
  </div>
</x-app-layout>
