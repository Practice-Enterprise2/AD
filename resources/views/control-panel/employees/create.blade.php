{{-- -*-html-*- --}}

<x-app-layout>
  <x-slot:title>
    {{ __('Control Panel - Employees') }}
  </x-slot:title>

  <x-control-panel-layout :always_show_title="true">
    <x-slot:title>
      {{ __('Create Employee') }}
    </x-slot:title>

    <x-employees.create />

  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
