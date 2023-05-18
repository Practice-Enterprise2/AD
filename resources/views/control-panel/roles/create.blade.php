{{-- -*-html-*- --}}

<x-app-layout>
  <x-slot:title>
    Control Panel - Groups
  </x-slot:title>

  <x-control-panel-layout :always_show_title="true">
    <x-slot:title>
      {{ __('Create Group') }}
    </x-slot:title>

    <x-slot:sidebar>
      @livewire('control-panel.sidebar')
    </x-slot:sidebar>

    @livewire('role.create')
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
