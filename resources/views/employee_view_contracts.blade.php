<x-app-layout>
  <h1 class="text-center text-xl p-8">Employee Contracts</h1>
  <div class="text-center">
    <a id="newemployee" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"  href="{{ route('create-contract-index') }}">new contract</a>
    </div> 
    @foreach ($contracts as $contract)
    <div class="text-center bg-white w-2/5 m-auto">

        <p>contract ID: {{ $contract["contractID"] }}</p>
        <p>employee id: {{ $contract["employeeID"] }}</p>
        <p>first name: {{ $contract["name"] }}</p>
        <p>last name: {{ $contract["lastname"] }}</p>
        
        <p>start date: {{ $contract["startdate"] }}</p>
        <p>end date: {{ $contract["enddate"] }}</p>
        <button class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">download contract</button>
    </div>
    @endforeach
</x-app-layout>