<x-app-layout>
  <x-sidebar-layout>
    <x-slot:sidebar>
      <x-control-panel.sidebar />
    </x-slot:sidebar>

    <h1 class="text-3xl font-extrabold">{{ __('Security') }}</h1>
    <table class="mt-5 w-full">
      <colgroup>
        <col span="1" class="w-3/12">
        <col span="1" class="w-9/12">
      </colgroup>
      <tr>
        <td>{{ __('Encrypted Cookies') }}</td>
        <td>
          {{ resolve(\App\Http\Kernel::class)->encrypted_cookies() ? 'on' : 'off' }}
        </td>
      </tr>
      <tr>
        <td>{{ __('Database Password') }}</td>
        <td>
          {{ config('database.connections')['mysql']['password'] ? 'Set' : 'Not Set' }}
        </td>
      </tr>
    </table>
  </x-sidebar-layout>
</x-app-layout>
<!-- vim: ft=html
-->
