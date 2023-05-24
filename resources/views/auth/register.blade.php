{{-- -*-html-*- --}}

<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    {{-- Name --}}
    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" class="mt-1 block w-full" type="text"
        name="name" :value="old('name')" required autofocus autocomplete="name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    {{-- Email Address --}}
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="mt-1 block w-full" type="email"
        name="email" :value="old('email')" required autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    {{-- Password --}}
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="mt-1 block w-full" type="password"
        name="password" required autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    {{-- Confirm Password --}}
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

      <x-text-input id="password_confirmation" class="mt-1 block w-full"
        type="password" name="password_confirmation" required
        autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <hr class="mt-4">

    {{-- Address section --}}
    <div class="mt-4">
      <x-input-label for="street" :value="__('Street')" />

      <x-text-input id="street" class="mt-1 block w-full" type="text"
        name="street" required autocomplete="address-line1" />

      <x-input-error :messages="$errors->get('street')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="house_number" :value="__('House number')" />

      <x-text-input id="house_number" class="mt-1 block w-full" type="text"
        name="house_number" required autocomplete="address-line2" />

      <x-input-error :messages="$errors->get('house_number')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="city" :value="__('City')" />

      <x-text-input id="city" class="mt-1 block w-full" type="text"
        name="city" required autocomplete="address-level2" />

      <x-input-error :messages="$errors->get('city')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="postal_code" :value="__('Postal Code')" />

      <x-text-input id="postal_code" class="mt-1 block w-full" type="text"
        name="postal_code" required autocomplete="postal-code" />

      <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="country" :value="__('Country')" />

      <x-text-input id="country" class="mt-1 block w-full" type="text"
        name="country" required autocomplete="country-name" />

      <x-input-error :messages="$errors->get('country')" class="mt-2" />
    </div>

    <div class="mt-4 flex items-center justify-end">
      <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
        href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ml-4">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
