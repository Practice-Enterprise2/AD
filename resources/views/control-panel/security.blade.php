{{-- -*-html-*- --}}

<x-app-layout>
  <x-control-panel-layout>
    <x-slot:title>{{ __('Security') }}</x-slot:title>
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
    <div class="my-5">
      <h2 class="text-xl font-bold">{{ __('Global Middleware') }}</h2>
      <table class="w-full">
        <colgroup>
          <col span="1" class="w-5/12">
          <col span="1" class="w-7/12">
        </colgroup>
        <tr class="text-left">
          <th>{{ __('Name') }}</th>
          <th>{{ __('Description') }}</th>
        </tr>
        @foreach (resolve('\App\Http\Kernel')->middleware() as $middleware)
          <tr>
            <td>{{ $middleware }}</td>
            @if (property_exists($middleware, 'description'))
              <td>{{ resolve($middleware)->description }}</td>
            @endif
          </tr>
        @endforeach
      </table>
    </div>
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
