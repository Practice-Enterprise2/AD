<x-sidebar-layout>
  @vite(['resources/css/control_panel/main.css'])

  <x-slot:sidebar>
    @livewire('control-panel.sidebar')
  </x-slot:sidebar>

  {{ $slot }}
</x-sidebar-layout>
{{-- vim: ft=html
--}}
