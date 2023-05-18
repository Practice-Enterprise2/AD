{{-- -*-html-*- --}}

<x-app-layout>
  <x-control-panel-layout>
    <x-slot:title>
      {{ __('Log') }}
    </x-slot:title>
    @livewire('log')
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
