<x-app-layout>
  <x-slot:header>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Create Pickup') }}
    </h2>
  </x-slot:header>

  <x-content-layout>
    <div class="py-10">
      <livewire:pickups.create :shipment_id=$shipment_id>
    </div>
  </x-content-layout>
</x-app-layout>
<!-- vim: ft=html
-->
