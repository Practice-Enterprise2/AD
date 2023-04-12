<x-app-layout>
  <x-sidebar-layout>
    <x-slot:sidebar>
      <x-control-panel.sidebar />
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Permissions') }}</h1>
    <div class="my-5">
      <table class="w-full">
        <colgroup>
          <col span="1" class="w-3/12">
          <col span="1" class="w-9/12">
        </colgroup>
        <tr class="text-left">
          <th>{{ __('Name') }}</th>
          <th>{{ __('Description') }}</th>
        </tr>
        @foreach (\Spatie\Permission\Models\Permission::all() as $permission)
          <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->description }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </x-sidebar-layout>
</x-app-layout>
<!-- vim: ft=html
-->