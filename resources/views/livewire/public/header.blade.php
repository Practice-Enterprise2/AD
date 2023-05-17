{{-- -*-html-*- --}}

<div
  class="relative flex h-[64px] items-center justify-between bg-sky-950 px-2 text-white"
  x-data="{ hamburger_open: false }">
  <div id="start" class="flex items-center gap-8">
    <a href="{{ route('landing-page') }}"
      class="flex items-center gap-2"><x-heroicon-o-paper-airplane
        class="h-8 w-8"></x-heroicon-o-paper-airplane>
      <h1 class="text-2xl font-bold">BlueSky</h1>
    </a>
    <div class="hidden items-stretch gap-4 sm:flex">
      <a href="{{ route('help') }}" class="text-lg font-semibold">Help</a>
      <div class="border-r border-r-sky-900"></div>
      <a href="{{ route('reviews.index') }}"
        class="text-lg font-semibold">Reviews</a>
    </div>
  </div>
  <div id="end" class="flex items-center gap-2">
    <div class="hidden sm:flex sm:items-center sm:gap-4">
      @guest
        <a href="{{ route('login') }}" class="p-1 text-lg font-bold">Sign In</a>
        <a href="{{ route('register') }}"
          class="rounded bg-white p-1 text-lg font-bold text-sky-950">Sign Up</a>
      @endguest
    </div>

    @auth
      {{-- Account button (small displays) --}}
      <a class="sm:hidden" href="{{ route('home') }}"><x-heroicon-o-user-circle
          class="h-10 w-10"></x-heroicon-o-user-circle></a>

      {{-- Account button (medium displays and above) --}}
      <div x-data="{ open: false }" class="relative hidden sm:block"
        x-on:click.outside="open = false">
        <button x-on:click="open = !open"><x-heroicon-o-user-circle
            class="h-10 w-10"></x-heroicon-o-user-circle></button>

        {{-- Account button popup menu --}}
        <div x-show="open"
          class="absolute right-0 flex w-[200px] flex-col items-stretch gap-2 overflow-hidden rounded-lg border border-sky-900 bg-sky-950">
          <a href="{{ route('home') }}"
            class="p-2 text-lg hover:bg-sky-900">Profile</a>
          <form action="/logout" method="POST">
            @csrf
            <button type="submit"
              class="w-full p-2 text-left text-lg hover:bg-sky-900">Log
              Out</button>
          </form>
        </div>

      </div>
    @endauth

    {{-- Hamburger menu (small displays) --}}
    <div class="flex items-center rounded p-1 sm:hidden"
      :class="hamburger_open ? 'bg-sky-900' : ''">
      <button id="button-hamburger-menu"
        x-on:click="hamburger_open = !hamburger_open">
        <x-heroicon-o-x-mark class="h-8 w-8" x-show="hamburger_open"
          x-cloak></x-heroicon-o-x-mark>
        <x-heroicon-o-bars-3 class="h-8 w-8"
          x-show="!hamburger_open"></x-heroicon-o-bars-3>
      </button>
    </div>
  </div>
  <div
    class="absolute left-0 top-full flex w-full flex-col gap-2 border-t border-t-sky-900 bg-sky-950 sm:hidden"
    x-show="hamburger_open" x-cloak
    x-class="{ hamburger_open: 'bg-yellow-50' }">
    @auth
      <a href="{{ route('home') }}" class="p-2 text-lg">Profile</a>
    @else
      <a href="{{ route('login') }}" class="p-2 text-lg">Sign In</a>
      <a href="{{ route('register') }}" class="p-2 text-lg">Sign Up</a>
    @endauth
    <a href="{{ route('help') }}" class="p-2 text-lg">Help</a>
    <a href="{{ route('reviews.index') }}" class="p-2 text-lg">Reviews</a>
    @auth
      <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="w-full p-2 text-left text-lg">Log
          Out</button>
      </form>
    @endauth
  </div>
</div>
{{-- vim: ft=html
--}}
