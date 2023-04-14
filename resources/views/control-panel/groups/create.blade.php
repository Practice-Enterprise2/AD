<x-app-layout>
  <x-slot:title>
    Control Panel - Groups
  </x-slot:title>

  <x-control-panel-layout>
    <x-slot:sidebar>
      @livewire('control-panel.sidebar')
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Create Group') }}</h1>
    @livewire('role.create')
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
