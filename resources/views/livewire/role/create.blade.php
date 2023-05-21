{{-- -*-html-*- --}}

<div>
  <form id="roles-form" wire:submit.prevent="save"
    class="grid w-full grid-cols-12 gap-3">
    <label for="name" class="col-span-3">Name</label>
    <div class="col-span-9">
      <input name="name" wire:model.lazy="role.name" type="text"
        class="w-full">
      @error('role.name')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <label for="description" class="col-span-3">Description</label>
    <div class="col-span-9">
      <textarea name="description" wire:model.defer="role.description" class="w-full"></textarea>
      @error('role.description')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <button type="save"
      class="col-span-2 rounded bg-blue-500 p-2 text-white">Save</button>
    @if (session()->has('message'))
      <div class="col-span-10">
        <span class="text-success">{{ session('message') }}</span>
      </div>
    @endif
  </form>
</div>
{{-- vim: ft=html
--}}
