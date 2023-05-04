<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <ol>
            <li><a href="{{ route('pickups.create') }}">New Pickup ></a></li>
            <li><a href="{{ route('pickups.index') }}">My Pickups ></a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
{{-- vim: ft=html
--}}
