<div
  class="flex h-[64px] items-center justify-between border-b border-b-sky-900 bg-sky-950 p-2 text-white"
  x-data="{ open: false }">
  <div id="start" class="flex items-center">
    <a href="{{ route('landing-page') }}"
      class="flex items-center gap-2"><x-heroicon-o-paper-airplane
        class="h-8 w-8"></x-heroicon-o-paper-airplane>
      <h1 class="text-2xl font-bold">BlueSky</h1>
    </a>
  </div>
  <div id="end" class="flex items-center gap-2">
    <div class="hidden sm:flex sm:items-center sm:gap-4">
      @guest
        <a href="{{ route('login') }}" class="text-lg font-bold">Log In</a>
      @endguest
      <a href="{{ route('faq.show') }}" class="text-lg font-bold">About</a>
    </div>
    @auth
      <a href="{{ route('home') }}"><x-heroicon-o-user-circle
          class="h-10 w-10"></x-heroicon-o-user-circle></a>
    @endauth
    <div class="flex items-center sm:hidden">
      <button id="button-hamburger-menu" x-on:click="open = !open">
        <x-heroicon-o-x-mark class="h-8 w-8" x-show="open"
          x-cloak></x-heroicon-o-x-mark>
        <x-heroicon-o-bars-3 class="h-8 w-8"
          x-show="!open"></x-heroicon-o-bars-3>
      </button>
    </div>
  </div>
  <div id="menu"
    class="absolute left-0 top-[50px] flex w-full flex-col gap-2 bg-sky-950 sm:hidden"
    x-show="open" x-cloak>
    <a href="{{ route('home') }}" class="p-2 text-lg">Profile</a>
    <a href="{{ route('faq.show') }}" class="p-2 text-lg">About</a>
  </div>
</div>
{{-- vim: ft=html
--}}
