{{-- -*-html-*- --}}

<div>
  <form wire:submit.prevent="save" class="grid w-full grid-cols-12 gap-4">
    <div class="col-span-6">
      <label for="first_name">First Name</label>
      <input name="first_name" type="text" wire:model="user.name" class="w-full">
      @error('user.first_name')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="col-span-6">
      <label for="last_name">Last Name</label>
      <input name="last_name" type="text" wire:model="user.last_name"
        class="w-full">
      @error('user.last_name')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="col-span-6">
      <label for="email">Email</label>
      <input name="email" type="text" wire:model="user.email"
        class="w-full">
      @error('user.email')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <x-primary-button>Save</x-primary-button>
  </form>
</div>
{{-- vim: ft=html
--}}
