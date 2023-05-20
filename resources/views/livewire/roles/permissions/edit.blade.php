{{-- -*-html-*- --}}

{{-- Livewire component for editing permissions granted to a role --}}
<div>
  <form wire:submit.prevent="add_permission">
    <label for="permission_to_add"><button>Add</button></label>
    <select name="permission_to_add" wire:model.defer="permission_to_add">
      @foreach ($unassigned_permissions as $permission)
        @if ($loop->first)
          <option value="{{ $permission->name }}" selected>
            {{ $permission->name }}</option>
        @else
          <option value="{{ $permission->name }}">{{ $permission->name }}
          </option>
        @endif
      @endforeach
    </select>
    @error('permission_to_add')
      <span class="text-danger">{{ $message }}</span>
    @enderror
  </form>
  <table class="w-full">
    <tr class="text-left">
      <th>Name</th>
      <th>Description</th>
    </tr>
    @foreach ($role->permissions as $permission)
      <tr>
        <td>{{ $permission->name }}</td>
        <td>{{ $permission->description }}</td>
        <td class="text-right"><button
            wire:click="remove_permission('{{ $permission->name }}')">Remove</button>
        </td>
      </tr>
    @endforeach
  </table>
</div>
{{-- vim: ft=html
--}}
