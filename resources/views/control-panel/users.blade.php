<x-app-layout>
  <x-control-panel-layout>
    <h1 class="text-3xl font-extrabold">{{ __('Users') }}</h1>

    @canany(['view_all_users', 'view_all_roles', 'edit_any_user_info'])
      <div class="mt-5">
        @livewire('users')
      </div>
      <div class="mt-5">
        <h2 class="text-xl font-bold">{{ __('User Management Pages') }}</h2>
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <ol>
            @can(['view_all_users', 'edit_any_user_info'])
              <li><a href="{{ route('users') }}">Users ></a></li>
            @endcan
            @can(['view_all_users', 'edit_any_user_info'])
              <li><a href="{{ route('customers') }}">Customers ></a></li>
            @endcan
            @can(['view_all_roles', 'edit_roles'])
              <li><a href="{{ route('roles') }}">Roles ></a></li>
            @endcan
          </ol>
        </div>
      </div>
    @endcanany

  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
