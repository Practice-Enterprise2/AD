<x-app-layout>
  <x-sidebar-layout>
    <x-slot:sidebar>
      <x-control-panel.sidebar />
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Users') }}</h1>
    @canany(['view_all_users', 'view_all_roles', 'edit_any_user_info'])
      <div class="mt-5">
        @foreach (\App\Models\User::all() as $user)
          {{ $user->name }}<br>
        @endforeach
      </div>
      <div class="my-5">
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
  </x-sidebar-layout>
</x-app-layout>
<!-- vim: ft=html
-->
