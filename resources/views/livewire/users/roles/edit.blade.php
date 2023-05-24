{{-- -*-html-*- --}}

<div>
  <form wire:submit.prevent="add_role">
    <label for="role_to_add"><button>Add</button></label>
    <select name="role_to_add" wire:model.defer="role_to_add">
      @foreach ($unassigned_roles as $role)
        @if ($loop->first)
          <option value="{{ $role->name }}" selected>{{ $role->name }}
          </option>
        @else
          <option value="{{ $role->name }}">{{ $role->name }}</option>
        @endif
      @endforeach
    </select>
    @error('role_to_add')
      <span class="text-danger">{{ $message }}</span>
    @enderror
  </form>
  <table class="w-full">
    <tr class="text-left">
      <th>Name</th>
      <th>Description</th>
    </tr>
    @foreach ($user->roles as $role)
      <tr>
        <td>{{ $role->name }}</td>
        <td>{{ $role->description }}</td>
        <td class="text-right"><button
            wire:click="remove_role('{{ $role->name }}')">Remove</button></td>
      </tr>
    @endforeach
  </table>
</div>
{{-- vim: ft=html
--}}
