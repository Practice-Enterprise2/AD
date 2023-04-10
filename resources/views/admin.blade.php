<x-app-layout>
  <x-content-layout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 place-items-center">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
              {{ __("Users") }}
              <x-nav-link class="bg-gray-200 rounded text-black ml-2" :href="route('users')"
                :active="request()->routeIs('users')">
                {{ __('Go >') }}
              </x-nav-link>
            </div>
          </div>
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
              {{ __("Role settings") }}
              <x-nav-link class="bg-gray-200 rounded text-black ml-2" :href="route('roles')"
                :active="request()->routeIs('roles')">
                {{ __('Go >') }}
              </x-nav-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-content-layout>
</x-app-layout>
<!-- vim: ft=html
-->
