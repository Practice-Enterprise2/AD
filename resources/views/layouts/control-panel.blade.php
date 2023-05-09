<x-sidebar-layout>
  @vite(['resources/css/layouts/control-panel.css'])

  @isset($title)
    <x-slot:title>
      {{ $title }}
    </x-slot:title>
  @endisset

  <x-slot:sidebar>
    @livewire('control-panel.sidebar')
  </x-slot:sidebar>

  {{ $slot }}
</x-sidebar-layout>
{{-- vim: ft=html
--}}
