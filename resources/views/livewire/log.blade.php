{{-- -*-html-*- --}}

<div>
  {{-- <!-- BUG: This doesn't adapt to the size of the parent! --> --}}
  <pre class="mt-5 h-[600px] w-[700px] overflow-scroll bg-black text-white">{{ $log }}</pre>
  <button wire:click="clear()">Clear log</button>
  <button wire:click="update()">Update</button>
</div>
