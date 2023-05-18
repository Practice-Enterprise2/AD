{{-- -*-html-*- --}}

<div>
  <form id="role-form" wire:submit.prevent="save"
    class="grid w-full grid-cols-12 gap-3">
    <label for="name" class="col-span-3">Name</label>
    <input name="name" wire:model="role.name" type="text" class="col-span-9">
    <label for="description" class="col-span-3">Description</label>
    <div class="col-span-9">
      <textarea name="description" form="role-form" wire:model="role.description"
        class="w-full"></textarea>
      @error('role.description')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <x-primary-button type="save"
      class="col-span-2 rounded bg-blue-500 p-2 text-white">Save</x-primary-button>
    @if (session()->has('message'))
      <div class="col-span-10">
        <span class="text-success">{{ session('message') }}</span>
      </div>
    @endif
  </form>
</div>
{{-- vim: ft=html
--}}
