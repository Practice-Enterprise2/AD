{{-- -*-html-*- --}}

<div x-data="{ sidebar_visible: 0 }" class="flex flex-row items-stretch">
  <aside class="w-full bg-white dark:bg-gray-700 md:hidden"
    x-show="sidebar_visible" x-cloak>
    <div class="p-2">
      @isset($sidebar)
        {{ $sidebar }}
      @endisset
    </div>
  </aside>
  <div role="main" class="w-full bg-white dark:bg-gray-700 md:hidden"
    x-show="!sidebar_visible" x-cloak>
    <div
      class="flex border-b border-gray-400 bg-gray-100 p-2 text-3xl font-bold dark:border-gray-600 dark:bg-gray-800">
      <button x-on:click="sidebar_visible = !sidebar_visible" class="ml-2">
        &lt</button>
      @isset($title)
        <h1 class="flex-grow text-center">
          {{ $title }}</h1>
      @endisset
    </div>
    <div class="p-2">
      {{ $slot }}
    </div>
  </div>
  <aside
    class="m-1 mr-0.5 hidden w-full flex-shrink-0 basis-80 rounded-lg border border-gray-400 bg-white dark:border-gray-600 dark:bg-gray-700 md:block">
    <div class="p-2">
      @isset($sidebar)
        {{ $sidebar }}
      @endisset
    </div>
  </aside>
  <div role="main"
    class="m-1 mr-0.5 hidden flex-grow rounded-lg border border-gray-400 bg-white dark:border-gray-600 dark:bg-gray-700 md:block">
    @if ($always_show_title)
      @isset($title)
        <div
          class="rounded-t-lg border-b border-gray-400 bg-gray-100 p-2 text-3xl font-bold dark:border-gray-600 dark:bg-gray-800">
          {{ $title }}</div>
      @endisset
    @endif
    <div class="p-2">
      {{ $slot }}
    </div>
  </div>
</div>
{{-- vim: ft=html
--}}
