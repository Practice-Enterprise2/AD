<div class="flex flex-col gap-2">
  <div>
    <x-nav-link class="w-full rounded bg-gray-200 p-3 text-xl dark:bg-gray-600"
      :href="route('control-panel.general')" :active="request()->routeIs('control-panel.general')">
      {{ __('General') }}
    </x-nav-link>
  </div>
  <div>
    <x-nav-link class="w-full rounded bg-gray-200 p-3 text-xl dark:bg-gray-600"
      :href="route('control-panel.security')" :active="request()->routeIs('control-panel.security')">
      {{ __('Security') }}
    </x-nav-link>
  </div>
  @canany(['view_all_users'])
    <div>
      <x-nav-link class="w-full rounded bg-gray-200 p-3 text-xl dark:bg-gray-600"
        :href="route('control-panel.users')" :active="request()->routeIs('control-panel.users')">
        {{ __('Users') }}
      </x-nav-link>
    </div>
  @endcanany
  @canany(['view_all_roles'])
    <div>
      <x-nav-link class="w-full rounded bg-gray-200 p-3 text-xl dark:bg-gray-600"
        :href="route('control-panel.groups')" :active="request()->routeIs('control-panel.groups')">
        {{ __('Groups') }}
      </x-nav-link>
    </div>
  @endcanany
  @canany(['view_all_permissions'])
    <div>
      <x-nav-link class="w-full rounded bg-gray-200 p-3 text-xl dark:bg-gray-600"
        :href="route('control-panel.permissions')" :active="request()->routeIs('control-panel.permissions')">
        {{ __('Permissions') }}
      </x-nav-link>
    </div>
  @endcanany
  @canany(['view_basic_server_info'])
    <div>
      <x-nav-link class="w-full rounded bg-gray-200 p-3 text-xl dark:bg-gray-600"
        :href="route('control-panel.info')" :active="request()->routeIs('control-panel.info')">
        {{ __('Info') }}
      </x-nav-link>
    </div>
  @endcanany
</div>
<!-- vim: ft=html
-->
