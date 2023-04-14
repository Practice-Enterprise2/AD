<x-app-layout>
  <x-slot:title>
    Control Panel - Users
  </x-slot:title>

  <x-control-panel-layout>
    <h1 class="text-3xl font-extrabold">{{ __('Edit User') }}</h1>
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
