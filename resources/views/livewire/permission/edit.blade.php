{{-- -*-html-*- --}}

{{-- Livewire component for editing a permission --}}
<div>
  <form id="permission-form" wire:submit.prevent="save"
    class="grid w-full grid-cols-12 gap-3">
    <label for="name" class="col-span-3">Name</label>
    <input disabled readonly name="name" wire:model="permission.name"
      type="text" class="col-span-9">
    <label for="description" class="col-span-3">Description</label>
    <div class="col-span-9">
      <textarea name="description" form="permission-form"
        wire:model="permission.description" class="w-full"></textarea>
      @error('permission.description')
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
