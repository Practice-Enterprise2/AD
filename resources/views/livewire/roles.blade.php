{{-- -*-html-*- --}}

<div>
  <input name="search" type="text" wire:model="search" autocomplete="off"
    placeholder="Search">
  <table class="w-full">
    <tr class="text-left">
      <th wire:click="sort_by('name')"
        class="border hover:cursor-pointer dark:border-white">Name</th>
      <th class="border dark:border-white">Description</th>
      <th class="border dark:border-white"></th>
    </tr>
    @foreach ($roles as $role)
      <tr>
        <td class="border dark:border-white">{{ $role->name }}</td>
        <td class="border dark:border-white">{{ $role->description }}</td>
        <td class="border text-right dark:border-white"><a
            href="{{ route('control-panel.roles.edit', ['role' => $role->id]) }}">Edit</a>
        </td>
      </tr>
    @endforeach
  </table>
  {{ $roles->links() }}
</div>
{{-- vim: ft=html
--}}
