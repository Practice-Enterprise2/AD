<x-app-layout>
  @vite(['resources/css/control_panel/main.css'])

  <x-slot:title>
    Control Panel - Groups
  </x-slot:title>

  <x-sidebar-layout>
    <x-slot:sidebar>
      <x-control-panel.sidebar />
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Create Group') }}</h1>
    @livewire('role.create')
  </x-sidebar-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
