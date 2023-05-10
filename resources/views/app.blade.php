<x-app-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          {{ __('Welcome to Blue Sky!') }}
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('readreviews') }}">{{ __('Reviews') }} &gt</a>

          {{-- Contact us dropdown menu --}}
          <x-dropdown>
            <x-slot name="trigger">
              <button
                class="mt-4 inline-flex items-center rounded-md border border-transparent border-white bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                Contact us
                <div class="ml-1">
                  <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
              </button>
            </x-slot>
            <x-slot name="content">
              <x-dropdown-link :href="route('contact.create')">
                {{ __('contact us') }}
              </x-dropdown-link>
              @can('view_all_complaints')
                <x-dropdown-link :href="route('contact.index')">
                  {{ __('complaints') }}
                </x-dropdown-link>
              @endcan
              <x-dropdown-link :href="route('complaints.messages')">
                {{ __('messages') }}
              </x-dropdown-link>
            </x-slot>
          </x-dropdown>
          <x-dropdown>
            <x-slot name="trigger">
              <button
                class="mt-4 inline-flex items-center rounded-md border border-transparent border-white bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                Shipments
                <div class="ml-1">
                  <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>

                </div>
              </button>
            </x-slot>

            <x-slot name="content">
              <x-dropdown-link :href="route('shipments.create')">
                {{ __('Request Shipment') }}
              </x-dropdown-link>
              @can('edit_all_shipments')
                <x-dropdown-link :href="route('shipments.requests')">
                  {{ __('Evaluate Shipment Requests') }}
                </x-dropdown-link>
              @endcan
              <x-dropdown-link :href="route('shipments.index')">
                {{ __('Show Confirmed Shipments') }}
              </x-dropdown-link>
              <x-dropdown-link :href="route('contact.create')">
                {{ __('contact us') }}
              </x-dropdown-link>
              @can('view_all_complaints')
                <x-dropdown-link :href="route('contact.index')">
                  {{ __('complaints') }}
                </x-dropdown-link>
              @endcan
              <x-dropdown-link :href="route('complaints.messages')">
                {{ __('messages') }}
              </x-dropdown-link>
            </x-slot>
          </x-dropdown>

          <a href="{{ route('faq.show') }}">{{ __('FAQ') }} &gt</a>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
