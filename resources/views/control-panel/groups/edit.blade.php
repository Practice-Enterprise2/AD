<x-app-layout>
  <x-slot:title>
    Control Panel - Groups
  </x-slot:title>

  <x-control-panel-layout>
    <x-slot:title>
      {{ __('Edit Group') }}
    </x-slot:title>

    <x-slot:sidebar>
      @livewire('control-panel.sidebar')
    </x-slot:sidebar>

    <div class="my-5">
      @livewire('groups.edit', ['role_id' => $group])
    </div>
    <div class="my-5">
      @livewire('groups.permissions.edit', ['role' => \App\Models\Role::findOrFail($group)])
    </div>
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
