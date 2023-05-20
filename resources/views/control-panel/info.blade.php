{{-- -*-html-*- --}}

<x-app-layout>
  <x-control-panel-layout>
    <x-slot:title>
      {{ __('Info') }}
    </x-slot:title>

    <div class="my-5">
      <h2 class="text-xl font-bold">Server Info</h2>
      <table class="w-full">
        <colgroup>
          <col span="1" class="w-3/12">
          <col span="1" class="w-9/12">
        </colgroup>
        <tr>
          <td>{{ __('Server OS') }}</td>
          <td>{{ php_uname('s') }}</td>
        </tr>
        <tr>
          <td>{{ __('Server Architecture') }}</td>
          <td>{{ php_uname('m') }}</td>
        </tr>
        @can('view_detailed_server_info')
          <tr>
            <td>{{ __('Temporary Path') }}</td>
            <td>{{ sys_get_temp_dir() }}</td>
          </tr>
        @endcan
      </table>
    </div>
    @can('view_detailed_server_info')
      <div class="my-5">
        <h2 class="text-xl font-bold">Environment</h2>
        <table class="w-full">
          <colgroup>
            <col span="1" class="w-3/12">
            <col span="1" class="w-9/12">
          </colgroup>
          {{-- <!-- PERF: Use a single variable instead of two calls to getenv(). --> --}}
          @foreach (array_keys(getenv()) as $key)
            <tr>
              <td>
                {{ $key }}
              </td>
              <td>
                {{ getenv()[$key] }}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    @endcan
    <div class="my-5">
      <h2 class="text-xl font-bold">PHP Info</h2>
      <table class="w-full">
        <colgroup>
          <col span="1" class="w-3/12">
          <col span="1" class="w-9/12">
        </colgroup>
        <tr>
          <td>{{ __('PHP Version') }}</td>
          <td>{{ phpversion() }}</td>
        </tr>
        @can('view_detailed_server_info')
          <tr>
            <td>{{ __('Include Path') }}</td>
            <td>{{ get_include_path() }}</td>
          </tr>
        @endcan
        <tr>
          <td>{{ __('Zend Version') }}</td>
          <td>{{ zend_version() }}</td>
        </tr>
      </table>
    </div>
  </x-control-panel-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
