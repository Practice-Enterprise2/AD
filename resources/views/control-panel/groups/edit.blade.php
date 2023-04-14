<x-app-layout>
  <x-slot:title>
    Control Panel - Groups
  </x-slot:title>

  <x-control-panel-layout>
    <x-slot:sidebar>
      @livewire('control-panel.sidebar')
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Edit Group') }}</h1>
    <div class="my-5">
      @livewire('groups.edit', ['role_id' => $group])
    </div>
    <div class="my-5">
      @livewire('groups.permissions.edit', ['role' => \Spatie\Permission\Models\Role::findOrFail($group)])
    </div>
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
