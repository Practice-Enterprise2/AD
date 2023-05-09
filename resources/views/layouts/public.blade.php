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

<body>
  @include('components.public.header')

  <main>
    {{ $slot }}
  </main>

  @livewireScripts
</body>

</html>
{{-- vim: ft=html
--}}
