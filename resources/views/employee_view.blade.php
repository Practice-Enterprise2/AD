{{-- -*-html-*- --}}

<x-app-layout>
  <div class="mx-auto">
    <h1 class="m-8 text-center">Employees Overview</h1>
    <div id="newemployeediv" class="m-8 text-center">
      <a id="newemployee"
        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
        href="{{ route('employee.create') }}">new employee</a>
    </div>
    <div id="searchcontainer" class="w-90">
      <form action="{{ route('employee-search') }}" method="GET"
        class="inline-block">
        <input type="text" name="query" placeholder="Search on name">
        <button type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Search</button>
      </form>
      <form action="{{ route('employee.overview') }}" method="GET"
        class="inline-block text-center">
        <button type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">View
          all</button>
      </form>
    </div>
    @if ($employees[0])
      @foreach ($employees as $employee)
        <div class="userpanel m-5 bg-white p-8">
          <form method="post" action="employee_edit" accept-charset="UTF-8">
            <input type="hidden" name="employeeId" value="{{ $employee[0] }}">
            <input type="hidden" name="userId" value="{{ $employee[1] }}">
            <input type="hidden" name="employeeFirstName"
              value="{{ $employee[2] }}">
            <input type="hidden" name="employeeLastName"
              value="{{ $employee[3] }}">
            @csrf
            <div class="innerpanel1">
              <p>ID: {{ $employee[0] }}</p>
              <p>User_id: {{ $employee[1] }}</p>
              <p>First name: {{ $employee[2] }}</p>
              <p>Last name: {{ $employee[3] }}</p>
            </div>
            <div class="innerpanel2">
              <p>Email: {{ $employee[4] }}</p>
              <p>Birth date: {{ $employee[5] }}</p>
              <p>Job title: {{ $employee[6] }}</p>
              <p>Salary: {{ $employee[7] }}</p>
            </div>
            <div class="theEditButton mt-3 text-center" style="clear:right">
              <button type="submit" id="editButton"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Edit</button>
            </div>
          </form>
        </div>
      @endforeach
    @endif

</x-app-layout>
