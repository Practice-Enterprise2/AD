<x-app-layout>
  <x-sidebar-layout>
    <x-slot:sidebar>
      <x-control-panel.sidebar />
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Users') }}</h1>
    <div class="mt-5">
      @foreach (\App\Models\User::all() as $user)
        {{ $user->name }}<br>
      @endforeach
    </div>
  </x-sidebar-layout>
</x-app-layout>
<!-- vim: ft=html
-->
