<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blue Sky</title>
  @vite('resources/css/app.css')


</head>

<body class="bg-gray-200">
  <header>
    <nav class="border-gray-200 bg-white px-4 py-2.5 dark:bg-gray-800 lg:px-6">
      <div
        class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center">
          <img
            src="https://as1.ftcdn.net/v2/jpg/05/27/24/36/1000_F_527243669_mhBh7M6Xb9hxg0y2Ug87XfQrlX20suMU.webp"
            class="mr-3 h-5" alt="Logo" />
          <span
            class="self-center whitespace-nowrap text-xl font-semibold dark:text-white">Blue
            Sky</span>
        </a>
        <div
          class="hidden w-full items-center justify-between lg:order-1 lg:flex lg:w-auto"
          id="mobile-menu-2">
          <ul
            class="mt-4 flex flex-col font-medium lg:mt-0 lg:flex-row lg:space-x-8">
            <li>
              <a href="#"
                class="block border-b border-gray-100 py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:border-0 lg:p-0 lg:hover:bg-transparent lg:hover:text-primary-700 lg:dark:hover:bg-transparent lg:dark:hover:text-white">Buy
                space</a>
            </li>
            <li>
              <a href="#"
                class="block border-b border-gray-100 py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:border-0 lg:p-0 lg:hover:bg-transparent lg:hover:text-primary-700 lg:dark:hover:bg-transparent lg:dark:hover:text-white">Support</a>
            </li>
            <li>
              <a href="#"
                class="block border-b border-gray-100 py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:border-0 lg:p-0 lg:hover:bg-transparent lg:hover:text-primary-700 lg:dark:hover:bg-transparent lg:dark:hover:text-white">Employees</a>
            </li>
            <li>
              <a href="#"
                class="block border-b border-gray-100 py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:border-0 lg:p-0 lg:hover:bg-transparent lg:hover:text-primary-700 lg:dark:hover:bg-transparent lg:dark:hover:text-white">Contact</a>
            </li>
            <ul
              class="mt-4 flex flex-col font-medium lg:mt-0 lg:flex-row lg:space-x-8">
              <!-- Authentication Links -->
              @guest
                @if (Route::has('login'))
                  <li class="nav-item">
                    <a class="block border-b border-gray-100 py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:border-0 lg:p-0 lg:hover:bg-transparent lg:hover:text-primary-700 lg:dark:hover:bg-transparent lg:dark:hover:text-white"
                      href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                @endif

                @if (Route::has('register'))
                  <li class="nav-item">
                    <a class="block border-b border-gray-100 py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:border-0 lg:p-0 lg:hover:bg-transparent lg:hover:text-primary-700 lg:dark:hover:bg-transparent lg:dark:hover:text-white"
                      href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
                @endif
              @else
                <li
                  class="block border-b border-gray-100 py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:border-0 lg:p-0 lg:hover:bg-transparent lg:hover:text-primary-700 lg:dark:hover:bg-transparent lg:dark:hover:text-white">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle"
                    href="{{ route('dashboard') }}" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" v-pre>
                    Dashboard
                  </a>
                </li>
              @endguest
            </ul>
          </ul>
        </div>

      </div>
    </nav>
  </header>
  <div class="flex items-center justify-center">
    @yield('content')
  </div>
</body>

</html>

</body>

</html>
