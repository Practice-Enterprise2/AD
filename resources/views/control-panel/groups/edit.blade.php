<x-app-layout>
  @vite(['resources/css/control_panel/main.css'])

  <x-slot:title>
    Control Panel - Groups
  </x-slot:title>

  <x-sidebar-layout>
    <x-slot:sidebar>
      <x-control-panel.sidebar />
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Edit Group') }}</h1>
    <div class="my-5">
      @livewire('groups.edit', ['role_id' => $group])
    </div>
    <div class="my-5">
      @livewire('groups.permissions.edit', ['role' => \Spatie\Permission\Models\Role::findOrFail($group)])
    </div>
  </x-sidebar-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
