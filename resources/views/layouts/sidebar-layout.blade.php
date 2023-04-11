<div class="flex min-h-screen flex-row items-stretch">
  <!-- BUG: This should be filling, not screen height. Couldn't get it to fill! -->
  <aside
    class="m-1 mr-0.5 w-1/2 rounded-lg border border-gray-400 bg-white dark:border-gray-600 dark:bg-gray-700 sm:w-1/3 md:w-1/5">
    <div class="p-2">
      @isset($sidebar)
        {{ $sidebar }}
      @endisset
    </div>
  </aside>
  <div role="main"
    class="m-1 mr-0.5 w-1/2 rounded-lg border border-gray-400 bg-white dark:border-gray-600 dark:bg-gray-700 sm:w-2/3 md:w-4/5">
    <div class="p-2">
      {{ $slot }}
    </div>
  </div>
</div>
<!-- vim: ft=html
-->
