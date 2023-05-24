{{-- -*-html-*- --}}

<x-app-layout>
  <x-slot:title>
    Control Panel - Users
  </x-slot:title>

  <x-control-panel-layout :always_show_title="true">
    <x-slot:title>
      {{ __('Edit User') }}
    </x-slot:title>

    <div class="my-5">
      <h2 class="text-xl font-extrabold">{{ __('General Information') }}</h2>
      @livewire('users.edit', ['user_id' => $user])
    </div>
    <div class="my-5">
      <h2 class="text-xl font-extrabold">{{ __('Role Management') }}</h2>
      @livewire('users.roles.edit', ['user' => \App\Models\User::findOrFail($user)])
    </div>
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
