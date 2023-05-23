<x-app-layout>
  <h1 class="p-8 text-center text-xl">Employee Contracts</h1>
  <div class="text-center">
    <a id="newemployee"
      class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
      href="{{ route('contract.index') }}">new contract</a><br><br>
    <form action="{{ route('employee-contract-search') }}" method="GET"
      class="inline-block">
      <input type="text" name="queryF" placeholder="Search on firstname">
      <input type="text" name="queryL" placeholder="Search on lastname">
      <button type="submit"
        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Search</button>
    </form>
    <form action="{{ route('employee-view-contracts') }}" method="GET"
      class="inline-block text-center">
      <button type="submit"
        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">View
        all</button>
    </form>
  </div>
  @if (@isset($contracts))
    <table class="mx-auto mt-20 w-2/4">
      <th>Contract ID</th>
      <th>Employee ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Start Date</th>
      <th>End Date</th>
      @foreach ($contracts as $contract)
        <tr class="h-11">

          <td>
            <p>{{ $contract['contractID'] }}</p>
          </td>
          <td>
            <p>{{ $contract['employeeID'] }}</p>
          </td>
          <td>
            <p>{{ $contract['name'] }}</p>
          </td>
          <td>
            <p>{{ $contract['lastname'] }}</p>
          </td>

          <td>
            <p>{{ $contract['startdate'] }}</p>
          </td>
          <td>
            <p>{{ $contract['enddate'] }}</p>
          </td>
          <td>
            <form action="{{ route('employee-contract-details') }}"
              method="POST" class="inline-block text-center">@csrf
              <input type="hidden" name="contractID"
                value="{{ $contract['contractID'] }}">
              <button type="submit"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">View
                Details
              </button>
            </form>
          </td>

        </tr>
      @endforeach
    </table>
  @endif
  @if (@isset($comboArray))
    <table class="mx-auto mt-20 w-2/4">
      <th>Contract ID</th>
      <th>Employee ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Start Date</th>
      <th>End Date</th>
      @foreach ($comboArray as $combo)
        <tr>

          <td>
            <p>{{ $combo['id'] }}</p>
          </td>
          <td>
            <p>{{ $combo['employee_id'] }}</p>
          </td>
          <td>
            <p>{{ $combo['name'] }}</p>
          </td>
          <td>
            <p>{{ $combo['last_name'] }}</p>
          </td>

          <td>
            <p>{{ $combo['start_date'] }}</p>
          </td>
          <td>
            <p>{{ $combo['stop_date'] }}</p>
          </td>
          <td>
            <form action="{{ route('employee-contract-details') }}"
              method="POST" class="inline-block text-center">@csrf
              <input type="hidden" name="contractID"
                value="{{ $combo['id'] }}">
              <button type="submit"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">View
                Details
              </button>
            </form>
          </td>

        </tr>
      @endforeach
    </table>
  @endif
</x-app-layout>
