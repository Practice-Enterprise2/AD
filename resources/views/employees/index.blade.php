{{-- -*-html-*- --}}

<x-app-layout>
  <div class="mx-auto">
    <h1 class="m-8 text-center">Employees Overview</h1>
    <div id="newemployeediv" class="m-8 text-center">
      <a id="newemployee"
        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
        href="{{ route('employees.create') }}">new employee</a>
    </div>
    <div id="searchcontainer" class="w-90">
      <form action="{{ route('employees.index') }}" method="GET"
        class="inline-block">
        <input type="text" name="query" placeholder="Search on name"
          autofocus class="text-gray-950">
        <button type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Search</button>
      </form>
      <a href="{{ route('employees.index') }}"
        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Show
        all</a>
    </div>
    @foreach ($employees as $employee)
      <div class="rounded bg-white p-4 dark:bg-gray-800">
        <div>
          <p>ID: {{ $employee->id }}</p>
          <p>User_id: {{ $employee->user_id }}</p>
          <p>First name: {{ $employee->user->name }}</p>
          <p>Last name: {{ $employee->user->last_name }}</p>
          <p>User Email: {{ $employee->user->email }}</p>
          <p>Birth date: {{ $employee->dateOfBirth }}</p>
          <p>Job title: {{ $employee->jobTitle }}</p>
          <p>Salary: {{ $employee->salary }}</p>
        </div>
        <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}"
          class="mx-auto block rounded bg-gray-200 p-2 text-center dark:bg-gray-600">Edit</a>
      </div>
    @endforeach
  </div>
</x-app-layout>
{{-- vim: ft=html
--}}
