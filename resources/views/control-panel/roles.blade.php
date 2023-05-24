{{-- -*-html-*- --}}

<x-app-layout>
  <x-control-panel-layout>
    <x-slot:title>
      {{ __('Groups') }}
    </x-slot:title>
    <div class="my-5">
      @livewire('roles')
      <div class="mt-10">
        @can('create_role')
          <a class="mt-5"
            href="{{ route('control-panel.roles.create') }}">{{ __('New Group') }}</a>
        @endcan
      </div>
    </div>
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
