<x-app-layout>
  <h1 class="p-8 text-center text-xl">Employee Contracts</h1>
  <div class="text-center">
    <a id="newemployee"
      class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
      href="{{ route('create-contract-index') }}">new contract</a>
  </div>
  @foreach ($contracts as $contract)
    <div class="m-auto w-2/5 bg-white text-center">

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
</x-app-layout>
