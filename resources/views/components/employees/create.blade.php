{{-- -*-html-*- --}}

<div class="mx-auto">
  <h1 class="m-5 text-center">New Employee</h1>
  @if ($errors->any())
    <h2 class="text-xl text-red-600">{{ $errors->first() }}</h2>
  @endif
  @if (\Session::has('alert'))
    <h2 class="text-xl text-lime-400">{!! \Session::get('alert') !!}</h2>
  @endif
  <div class="bg-gray-200 p-8">
    <form method="post" action="{{ route('employees.store') }}"
      accept-charset="UTF-8">
      @csrf
      <div class="clearfix">
        <div id="left" class="float-left w-60">
          <label for="firstName">First name:</label>
          <br><br>

          <label for="lastName">Last name:</label>
          <br><br>
          <label for="mail">mail:</label>
          <br><br>
          <label for="street">street:</label>
          <br><br>
          <label for="houseNumber">house number:</label>
          <br><br>
          <label for="province">province:</label>
          <br><br>
          <label for="city">city:</label>
          <br><br>
          <label for="postalCode">postalcode:</label><br><br>
          <label for="country">country:</label>
          <br><br>
          <label for="phonenumber">phonenumber:</label>
          <br><br>
          <label for="dateOfBirth">date of birth:</label><br><br>
          <label for="jobTitle">job title:</label><br><br>
          <label for="salary">salary:</label><br><br>
          <label for="password">password:</label><br><br>
          <label for="Iban">Iban:</label>
        </div>
        <div id="right" class="float-left">

          <input type="text" id="Name" name="name" required><br><br>

          <input type="text" id="lastName" name="last_name"
            required><br><br>

          <input type="email" id="mail" name="email" required><br><br>

          <input type="text" id="street" name="street" required><br><br>

          <input type="number" id="houseNumber" name="houseNumber"
            required><br><br>

          <input type="text" id="province" name="province" required><br><br>

          <input type="text" id="city" name="city" required><br><br>

          <input type="number" id="postalCode" name="postalCode"
            required><br><br>

          <input type="text" id="country" name="country" required><br><br>

          <input type="tel" id="phoneNumber" name="phoneNumber"
            required><br><br>

          <input type="date" id="dateOfBirth" name="dateOfBirth"
            required><br><br>

          <input type="text" id="jobTitle" name="jobTitle" required><br><br>

          <input type="number" id="salary" name="salary" required><br><br>

          <input type="password" id="password" name="password"
            required><br><br>

          <input type="int" id="Iban" name="Iban" required><br><br>
        </div>
      </div>
      <div class="mt-2 text-center">
        <a href="{{ route('employees.index') }}"
          class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Back</a>
        <button type="reset"
          class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">reset</button>
        <button type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">New</button>
      </div>
    </form>
  </div>
</div>
