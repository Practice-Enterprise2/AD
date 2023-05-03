<x-app-layout>

  <h1>New Employee Contract</h1>
  <form method="post" action="employee_add_contract_done" accept-charset="UTF-8">
    @csrf

    
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

    <button type="reset">reset</button>
    <button type="submit">Add</button>
  </form>
</x-app-layout>
