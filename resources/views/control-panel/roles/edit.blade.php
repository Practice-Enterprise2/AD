{{-- -*-html-*- --}}

<x-app-layout>
  <x-slot:title>
    Control Panel - Groups
  </x-slot:title>

  <x-control-panel-layout :always_show_title="true">
    <x-slot:title>
      {{ __('Edit Group') }}
    </x-slot:title>

    <x-slot:sidebar>
      @livewire('control-panel.sidebar')
    </x-slot:sidebar>

    <div class="my-5">
      @livewire('roles.edit', ['role_id' => $role])
    </div>
    <div class="my-5">
      @livewire('roles.permissions.edit', ['role' => \App\Models\Role::findOrFail($role)])
    </div>
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
