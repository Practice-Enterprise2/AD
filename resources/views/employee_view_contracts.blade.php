<x-app-layout>
  <h1 class="p-8 text-center text-xl">Employee Contracts</h1>
  <div class="text-center">
    <a id="newemployee"
    class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
      href="{{ route('create-contract-index') }}">new contract</a><br><br>
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
  @if(@isset($contracts))
  @foreach ($contracts as $contract)
    <div class="mx-auto w-2/6 bg-white text-center m-5">

      <p>contract ID: {{ $contract['contractID'] }}</p>
      <p>employee id: {{ $contract['employeeID'] }}</p>
      <p>first name: {{ $contract['name'] }}</p>
      <p>last name: {{ $contract['lastname'] }}</p>

      <p>start date: {{ $contract['startdate'] }}</p>
      <p>end date: {{ $contract['enddate'] }}</p>
      <button
        class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700">download
        contract</button>
    </div>
  @endforeach
  @endif
  @if(@isset($comboArray))
    @foreach($comboArray as $combo)
     
      
    <div class="mx-auto w-2/6 bg-white text-center m-5">

      <p>contract ID: {{ $combo['id'] }}</p>
      <p>employee id: {{ $combo['employee_id'] }}</p>
      <p>first name: {{ $combo['name'] }}</p>
      <p>last name: {{ $combo['last_name']}}</p>

      <p>start date: {{ $combo['start_date'] }}</p>
      <p>end date: {{$combo['stop_date'] }}</p>
      <button
        class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700">download
        contract</button>
    </div>
    
      @endforeach
    
  @endif
</x-app-layout>
