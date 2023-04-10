<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Employee Dashboard') }}
    </h2>
  </x-slot>

  <x-content-layout>
    <div class="py-12">
      <div class="p-6 text-gray-900 dark:text-gray-100">
        {{ __("Customers overview") }}
        <x-nav-link class="bg-gray-200 rounded text-black ml-2" href="{{ route('customers') }}" target="_blank">
          {{ __('Go >') }}
        </x-nav-link>
      </div>
    </div>
    <div>
    <x-airport-selector inputName="des" />
  </div>
  </x-content-layout>
</x-app-layout>
<!-- vim: ft=html
-->
