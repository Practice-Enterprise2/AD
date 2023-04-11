<x-app-layout>
  <x-sidebar-layout>
    <x-slot:sidebar>
      <x-control-panel.sidebar />
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">Log</h1>
    <pre class="mt-5 h-96 overflow-auto bg-black text-white">{{ file_get_contents(storage_path() . '/logs/laravel.log') }}</pre>
  </x-sidebar-layout>
</x-app-layout>
<!-- vim: ft=html
-->
