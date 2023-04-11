<x-app-layout>
  <x-slot name="header">
    <h2
      class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Employee Dashboard') }}
    </h2>
  </x-slot>

  <x-content-layout>
    <div class="py-12">
      <div class="p-6 text-gray-900 dark:text-gray-100">
        {{ __('Customers overview') }}
        <x-nav-link class="ml-2 rounded bg-gray-200 text-black"
          href="{{ route('customers') }}" target="_blank">
          {{ __('Go >') }}
        </x-nav-link>
      </div>
    </div>
  </x-content-layout>
</x-app-layout>
<!-- vim: ft=html
-->
