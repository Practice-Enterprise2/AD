<x-app-layout>
  <x-slot:title>
    Control Panel - Permissions
  </x-slot:title>

  <x-control-panel-layout>
    <x-slot:title>
      {{ __('Edit Permission') }}
    </x-slot:title>

    @livewire('permission.edit', ['permission' => $permission])
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
