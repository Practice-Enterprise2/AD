{{-- -*-html-*- --}}

<x-app-layout>
  <div class="mx-auto">
    <h1 class="m-5 text-center">Employee Edit</h1>
    <h1 class="m-5 text-center">{{ $employee->user->name }}
      {{ $employee->user->last_name }}
    </h1>
    <div class="bg-gray-200 p-8 dark:bg-gray-800">
      <form method="post"
        action="{{ route('employees.update', ['employee' => $employee->id]) }}"
        accept-charset="UTF-8">
        <input type="hidden" name="userId" value="{{ $employee->user->id }}">
        @csrf
        <div class="clearfix">
          <div id="left" class="float-left w-60">
            <label for="firstName">First name:</label><br><br>
            <label for="lastName">Last name:</label><br><br>
            <label for="mail">mail:</label><br><br>
            <label for="email">Company email:</label><br><br>
            <label for="street">street:</label><br><br>
            <label for="houseNumber">house number:</label><br><br>
            <label for="province">province:</label><br><br>
            <label for="city">city:</label><br><br>
            <label for="postalCode">postalcode:</label><br><br>
            <label for="country">country:</label><br><br>
            <label for="phonenumber">phonenumber:</label><br><br>
            <label for="dateOfBirth">date of birth:</label><br><br>
            <label for="jobTitle">job title:</label><br><br>
            <label for="salary">salary:</label><br><br>
            <label for="Iban">Iban:</label>
          </div>
          <div id="right" class="float-left">
            <input class="text-gray-950" type="text" id="Name"
              name="user_name" value="{{ $employee->user->name }}"
              autofocus><br><br>
            <input class="text-gray-950" type="text" id="lastName"
              name="user_last_name"
              value="{{ $employee->user->last_name }}"><br><br>
            <input class="text-gray-950" type="email" id="mail"
              name="user_email" value="{{ $employee->user->email }}"><br><br>
            <input class="text-gray-950" type="email" id="email"
              name="email" value="{{ $employee->email }}"><br><br>
            <input class="text-gray-950" type="text" id="street"
              name="user_address_street"
              value="{{ $employee->user->address ? $employee->user->address->street : '' }}"><br><br>
            <input class="text-gray-950" type="text" id="houseNumber"
              name="user_address_house_number"
              value="{{ $employee->user->address ? $employee->user->address->house_number : '' }}"><br><br>
            <input class="text-gray-950" type="text" id="province"
              name="user_address_region"
              value="{{ $employee->user->address ? $employee->user->address->region : '' }}"><br><br>
            <input class="text-gray-950" type="text" id="city"
              name="user_address_city"
              value="{{ $employee->user->address ? $employee->user->address->city : '' }}"><br><br>
            <input class="text-gray-950" type="number" id="postalCode"
              name="user_address_postal_code"
              value="{{ $employee->user->address ? $employee->user->address->postal_code : '' }}"><br><br>
            <input class="text-gray-950" type="text" id="country"
              name="user_address_country"
              value="{{ $employee->user->address ? $employee->user->address->country : '' }}"><br><br>
            <input class="text-gray-950" type="tel" id="phoneNumber"
              name="user_phone" value="{{ $employee->user->phone }}"><br><br>
            <input class="text-gray-950" type="date" id="dateOfBirth"
              name="dateOfBirth" value="{{ $employee->dateOfBirth }}"><br><br>
            <input class="text-gray-950" type="text" id="jobTitle"
              name="jobTitle" value="{{ $employee->jobTitle }}"><br><br>
            <input class="text-gray-950" type="number" id="salary"
              name="salary" value="{{ $employee->salary }}"><br><br>
            <input class="text-gray-950" type="int" id="Iban"
              name="Iban" value="{{ $employee->Iban }}"><br><br>
          </div>
        </div>
        <div class="mt-2 text-center">
          <a href="{{ route('employees.index') }}"
            class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Back</a>
          <button type="reset"
            class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">reset</button>
          <button type="submit"
            class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Save
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
{{-- vim: ft=html
--}}
