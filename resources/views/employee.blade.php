<x-app-layout>
    <div class="py-12">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ __("Customers overview") }}
            <x-nav-link class="bg-gray-200 rounded text-black ml-2" href="{{ route('customers') }}" target="_blank">
                {{ __('Go >') }}
            </x-nav-link>
        </div>
    </div>


    <div>
        <x-airport-selector inputName="desitinationAirport" />
        <x-airport-selector inputName="startAirport" />
    </div>

    



</x-app-layout>
