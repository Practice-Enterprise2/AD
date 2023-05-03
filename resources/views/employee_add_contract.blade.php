<x-app-layout>
<div class="text-center bg-white w-2/5 m-auto">
  <h1 class="text-center text-xl p-8">New Employee Contract</h1>
  
  <form method="post" action="employee_add_contract_done" accept-charset="UTF-8">
    @csrf
    
    <label for="employeeID">Select an employee:</label>
    <select name="employeeID" id="employeeID" required>
    @foreach ($users as $user)
      <option value="{{$user['employeeID']}}">{{$user['name']}} {{$user['lastname']}}</option>
    @endforeach
    </select>
    <br>
    
    <label for="startdate">Start date:</label>
    <input type="date" id="startdate" name="startdate" required><br>
    <label for="stopdate">Stop date:</label>
    <input type="date" id="stopdate" name="stopdate" required><br>

    <br>

    <button type="reset" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">reset</button>
    <button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Add</button>
  </form>
  </div>
</x-app-layout>
