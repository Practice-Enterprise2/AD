{{-- -*-html-*- --}}

<x-app-layout>
  <x-control-panel-layout>
    <x-slot:title>{{ __('Employees') }}</x-slot:title>

    @livewire('employees.index')

    <div class="mt-5">
      <h2 class="text-xl font-bold">{{ __('Employee Management Pages') }}</h2>
      <div class="p-6 text-gray-900 dark:text-gray-100">
        <ol>
          @can(['add_employee'])
            <li><a href="{{ route('control-panel.employees.create') }}">Create
                Employee &gt</a></li>
          @endcan
        </ol>
      </div>
    </div>

  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
