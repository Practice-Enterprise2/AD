<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    {{ config('app.name', 'Laravel') . ($title ?? false ? " - $title" : '') }}
  </title>

  @isset($head)
    {{ $head }}
  @endisset

  {{-- Scripts --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body
  class="flex h-screen flex-col justify-stretch bg-gray-100 font-sans antialiased dark:bg-gray-900">
  @include('components.navigation')

  @if (isset($header))
    <header class="bg-white shadow dark:bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
  @endif

  <main class="contents">
    {{ $slot }}
  </main>

  @livewireScripts
</body>

</html>
{{-- vim: ft=html
--}}
