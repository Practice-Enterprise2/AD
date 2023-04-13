<nav x-data="{ open: false }"
  class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
  <!-- Primary Navigation Menu -->
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 justify-between">
      <div class="flex">
        <!-- Logo -->
        <div class="flex shrink-0 items-center">
          <a href="{{ route('home') }}">
            <x-application-logo
              class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
          </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
            {{ __('Home') }}
          </x-nav-link>
          @auth
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
              {{ __('Dashboard') }}
            </x-nav-link>
          @endauth
          @can('view_general_employee_content')
            <x-nav-link :href="route('employee')" :active="request()->routeIs('employee')">
              {{ __('Employee') }}
            </x-nav-link>
          @endcan
          @canany(['view_basic_server_info', 'view_all_users', 'view_all_roles',
            'view_detailed_server_info', 'edit_roles'])
            <x-nav-link :href="route('control-panel')" :active="str_starts_with(
                request()
                    ->route()
                    ->getName(),
                'control-panel',
            )">
              {{ __('Control Panel') }}
            </x-nav-link>
          @endrole
        </div>
      </div>

      @auth
        {{-- Validations needed for later. --}}
        {{-- <x-nav-link :href="route('shipments.create')">
        {{ __('Request Shipment') }}
      </x-nav-link>
      <x-nav-link :href="route('shipments.requests')">
        {{ __('Evaluate Shipment Requests') }}
      </x-nav-link>
      <x-nav-link :href="route('shipments.index')">
        {{ __('Show Confirmed Shipments') }}
      </x-nav-link> --}}
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
            <x-dropdown-link :href="route('shipments.requests')">
              {{ __('Evaluate Shipment Requests') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('shipments.index')">
              {{ __('Show Confirmed Shipments') }}
            </x-dropdown-link>
            <x-dropdown-link href="/shipments">
              {{ __('Show Shipments') }}
            </x-dropdown-link>
            @if(Auth::user()->roles()->first()->name == 'admin' || Auth::user()->roles()->first()->name == 'employee')
            <x-dropdown-link href="">
              {{ __('Shipments overview page') }}
            </x-dropdown-link>
            @endif
          </x-slot>
        </x-dropdown>
      @endauth

      <!-- Settings Dropdown -->
      <div class="hidden sm:ml-6 sm:flex sm:items-center">

        @guest
          <a class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
            href="{{ route('login') }}">{{ __('Login') }}</a>
          <a class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
            href="{{ route('register') }}">{{ __('Register') }}</a>
        @else
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button
                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                @guest
                  @if (Route::has('login'))
                    <a class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                      href="{{ route('login') }}">{{ __('Login') }}</a>
                  @endif
                  @if (Route::has('register'))
                    <a class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                      href="{{ route('register') }}">{{ __('Register') }}</a>
                  @endif
                @else
                  <div>
                    @livewire('username')
                  </div>
                @endguest
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
              @if (Route::has('login'))
                <x-dropdown-link :href="route('profile.edit')">
                  {{ __('Profile') }}
                </x-dropdown-link>
              @endif
              <!-- Authentication -->

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                @guest
                @else
                  <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                  </x-dropdown-link>
                @endguest
              </form>
            </x-slot>
          </x-dropdown>
        @endguest
      </div>

      <!-- Hamburger -->
      <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
          <svg class="h-6 w-6" stroke="currentColor" fill="none"
            viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }"
              class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }"
              class="hidden" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="space-y-1 pb-3 pt-2">
      <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
      </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
      @auth
        <div class="px-4">
          <div class="text-base font-medium text-gray-800 dark:text-gray-200">
            {{ Auth::user()->name }}</div>
          <div class="text-sm font-medium text-gray-500">
            {{ Auth::user()->email }}</div>
        </div>
      @endauth
      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')">
          {{ __('Profile') }}
        </x-responsive-nav-link>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          @guest
          @else
            <x-responsive-nav-link :href="route('logout')"
              onclick="event.preventDefault();
                                        this.closest('form').submit();">
              {{ __('Log Out') }}
            </x-responsive-nav-link>
          @endguest
        </form>
      </div>
    </div>
  </div>
</nav>
{{-- vim: ft=html
--}}
