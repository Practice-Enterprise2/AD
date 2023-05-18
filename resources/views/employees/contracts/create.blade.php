{{-- -*-html-*- --}}

<x-app-layout>
  <h1>New Employee Contract</h1>
  <form method="post"
    action="{{ route('employees.contracts.store', ['employee' => $employee->id]) }}"
    accept-charset="UTF-8">
    @csrf
    <input type="hidden" id="employeeID" name="employeeID"
      value="{{ $employee->id }}" required>
    <label for="startdate">Start date:</label>
    <input type="date" id="startdate" name="startdate" required><br>
    <label for="stopdate">Stop date:</label>
    <input type="date" id="stopdate" name="stopdate" required><br>
    <br>
    <button type="reset">reset</button>
    <button type="submit">Add</button>
  </form>
</x-app-layout>
{{-- vim: ft=html
--}}
