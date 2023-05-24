{{-- -*-html-*- --}}

<div>
  <input name="search" type="text" wire:model="search" autocomplete="off"
    placeholder="Search">
  <table class="w-full">
    <tr class="text-left">
      <th wire:click="sort_by('name')"
        class="border hover:cursor-pointer dark:border-white">First Name</th>
      <th wire:click="sort_by('last_name')"
        class="border hover:cursor-pointer dark:border-white">Last Name</th>
      <th wire:click="sort_by('email')"
        class="border hover:cursor-pointer dark:border-white">Email</th>
      <th wire:click="sort_by('email')"
        class="border hover:cursor-pointer dark:border-white">Permissions</th>
      <th class="border dark:border-white"></th>
    </tr>
    @foreach ($users as $user)
      <tr>
        <td class="border dark:border-white">{{ $user->name }}</td>
        <td class="border dark:border-white">{{ $user->last_name }}</td>
        <td class="border dark:border-white">{{ $user->email }}</td>
        <td class="border dark:border-white">
          <ul>
            @foreach ($user->get_permissions() as $permission)
              <li>{{ $permission->name }}</li>
            @endforeach
          </ul>
        </td>
        <td class="border text-right dark:border-white"><a
            href="{{ route('control-panel.users.edit', ['user' => $user->id]) }}">Edit</a>
        </td>
      </tr>
    @endforeach
  </table>
  {{ $users->links() }}
</div>
{{-- vim: ft=html
--}}
