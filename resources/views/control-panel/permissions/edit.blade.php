<x-app-layout>
  <x-slot:title>
    Control Panel - Permissions
  </x-slot:title>

  <x-control-panel-layout>
    <h1 class="text-3xl font-extrabold">{{ __('Edit Permission') }}</h1>
    @livewire('permission.edit', ['permission' => $permission])
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
