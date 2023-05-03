<x-app-layout>
  <div class="m-auto w-2/5 bg-white text-center">
    <h1 class="p-8 text-center text-xl">New Employee Contract</h1>

    <form method="post" action="employee_add_contract_done"
      accept-charset="UTF-8">
      @csrf

      <label for="employeeID">Select an employee:</label>
      <select name="employeeID" id="employeeID" required>
        @foreach ($users as $user)
          <option value="{{ $user['employeeID'] }}">{{ $user['name'] }}
            {{ $user['lastname'] }}</option>
        @endforeach
      </select>
      <br>

      <label for="startdate">Start date:</label>
      <input type="date" id="startdate" name="startdate" required><br>
      <label for="stopdate">Stop date:</label>
      <input type="date" id="stopdate" name="stopdate" required><br>

      <br>

      <button type="reset"
        class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700">reset</button>
      <button type="submit"
        class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700">Add</button>
    </form>
  </div>
</x-app-layout>
