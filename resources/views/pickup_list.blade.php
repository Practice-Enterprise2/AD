{{-- -*-html-*- --}}

<x-app-layout>
  <x-slot:header>
    <h2
      class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('My Pickups') }}
    </h2>
  </x-slot:header>

  <x-content-layout>
    <livewire:pickups.index>
  </x-content-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
