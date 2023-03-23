<x-app-layout>
<div class="w-screen flex flex-col justify-start items-center  text-gray-900 dark:text-gray-100">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Shipment') }}
        </h2>
        @foreach ($shipments as $ship)
        <div class="w-10/12 py-10 bg-slate-800 my-8 px-8 rounded flex flex-row">
        <div class="w-8/12">
        <h2>From: {{$ship->from_name}}</h2>
        <h2>City: {{$ship->from_city}}</h2>

        <h2>To: {{$ship->to_name}}</h2>
        <h2>City: {{$ship->to_city}}</h2>
        <h2>Status: @if($ship->status == 0)
            Pending
            @elseif($ship->status == 1)
            Processing
            @else
            Completed
            @endif
        </h2>
        </div>
        <div>
        @if($ship->status == 0)
        <form
                    action="{{ route('shipment.destroy', $ship->id) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex items-center gap-4">
            <button class="bg-red-500 rounded px-3 py-2 my-2">{{ __('Delete') }}</button>
        </div>

                    </form>
            
        @elseif($ship->status == 1)
            <a href="{{route('contact.create')}}" class="text-red-500 px-1 mx-4">Request cancel</a>
        @else
        <form
                    action="{{ route('shipment.destroy', $ship->id) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex items-center gap-4">
            <button class="bg-red-500 rounded px-3 py-2 my-2">{{ __('Delete') }}</button>
        </div>
        <a href="{{route('contact.create')}}" class="text-red-500 px-1 mx-4">I haven't receive my package...</a>

        @endif
            <a href="{{route('shipment.show', $ship->id)}}" class="text-blue-200">Detail...</a>
        </div>
        </div>
        @endforeach
    </div>
</x-app-layout>