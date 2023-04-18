<x-app-layout>
  <x-control-panel-layout>
    <x-slot:title>
      {{ __('Groups') }}
    </x-slot:title>
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
        @foreach (\App\Models\Role::all() as $role)
          <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->description }}</td>
            <td class="text-right"><a
                href="{{ route('control-panel.groups.edit', ['group' => $role->id]) }}">Edit</a>
            </td>
          </tr>
        @endforeach
      </table>

      <div class="mt-10">
        @can('create_role')
          <a class="mt-5" href="{{ route('control-panel.groups.create') }}">New
            Group</a>
        @endcan
      </div>
    </div>
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
