<x-app-layout>
<div class="w-screen flex flex-col items-center justify-center text-gray-900 dark:text-gray-100">
    <h2 class="text-lg font-medium py-5 text-gray-900 dark:text-gray-100">
            {{ __('Shipment Detail') }} 
    </h2>
    <h2 class="text-lg font-medium py-5 text-gray-900 dark:text-gray-100">Shipment ID: {{$shipment->id}}</h2>
    <div class="w-8/12 flex flex-row justify-center items-start">
        <div class="w-1/2 flex flex-col gap-4">
            <h2>Sender Name: {{$shipment->from_name}}</h2>
            <h2>Sender Phone:{{$shipment->from_phone}}</h2>
            <h2>Sender Address: {{$shipment->from_address}}</h2>
            <h2>Sender PostalCode: {{$shipment->from_postalcode}}</h2>
            <h2>Sender City: {{$shipment->from_city}}</h2>
            <h2>Sender Country: {{$shipment->from_country}}</h2>
            <h2>Total Weight: {{$shipment->weight}}</h2>
            <h2>Number of Packages: {{$shipment->package_num}}</h2>
            <h2>Total Price: {{$shipment->price}}</h2>
            <h2>Status: @if($shipment->status == 0)
                Sending request
                @elseif($shipment->status == 1)
                Processing
                @else
                Completed
                @endif
            </h2>
        </div>
        <div class="w-1/2 flex flex-col gap-4">
            <div class="w-full flex flex-col gap-4">
        <h2>Recipient Name: {{$shipment->to_name}}</h2>
            <h2>Recipient Phone: {{$shipment->to_phone}}</h2>
            <h2>Recipient Address: {{$shipment->to_address}}</h2>
            <h2>Recipient PostalCode: {{$shipment->to_postalcode}}</h2>
            <h2>Recipient City: {{$shipment->to_city}}</h2>
            <h2>Recipient Country: {{$shipment->to_country}}</h2>
            </div>
            <div class="w-full flex flex-col gap-4">
            @if($shipment->status == 0)
            <form
                    action="{{ route('shipment.destroy', $shipment->id) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex items-center gap-4">
            <button class="bg-red-500 rounded px-3 py-2 my-2">{{ __('Delete') }}</button>
        </div>

                    </form>
            <a href="{{route('shipment.edit', $shipment->id)}}" class="text-blue-500 px-1 mx-4">Edit</a>

            
        @elseif($shipment->status == 1)
            <a href="{{route('contact.create')}}" class="text-red-500 px-1 mx-4">Request cancel</a>
        @else
        <form
                    action="{{ route('shipment.destroy', $shipment->id) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex items-center gap-4">
            <button class="bg-red-500 rounded px-3 py-2 my-2">{{ __('Delete') }}</button>
        </div>

                    </form>
        <a href="{{route('contact.create')}}" class="text-red-500 px-1 mx-4">I haven't receive my package...</a>

        @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>