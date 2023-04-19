<div>
  <label for="search">Search</label>
  <input name="search" type="text" class="w-full" wire:model="search"
    autocomplete="off">
  <table class="w-full">
    <tr class="text-left">
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
    </tr>
    @foreach ($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td class="text-right"><a
            href="{{ route('control-panel.users.edit', ['user' => $user->id]) }}">Edit</a>
        </td>
      </tr>
    @endforeach
  </table>
  {{ $users->links() }}
</div>
{{-- vim: ft=html
--}}
