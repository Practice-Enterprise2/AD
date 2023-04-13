<x-app-layout>
  @vite(['resources/css/control_panel/main.css'])

  <x-slot:title>
    Control Panel - Permissions
  </x-slot:title>

  <x-sidebar-layout>
    <x-slot:sidebar>
      <x-control-panel.sidebar />
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Edit Permission') }}</h1>
    @livewire('permission.edit', ['permission' => $permission])
  </x-sidebar-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
