
<x-app-layout>
  <style>
    .userpanel {
      width: 350px;
      background-color: azure;
      padding: 25px;
      margin-top: 50px;
      clear: both;
    }

    a#newemployee {
      color: cadetblue;
      padding: 5px;
      margin-top: 50px;
    }

    a#newemployee:hover {
      background-color: purple;
    }
  </style>
  <div>
    <a id="newemployee" href="{{ route('employee.create') }}">new employee</a>
    @if ($employees[0])
    @foreach ($employees as $employee)
      <div class="userpanel">

        <p>ID: {{ $employee[0] }}</p>
        <p>User_id: {{ $employee[1] }}</p>
        <p>First name: {{ $employee[2] }}</p>
        <p>Last name: {{ $employee[3] }}</p>
        <p>Email: {{ $employee[4] }}</p>
        <p>Birth date: {{ $employee[5] }}</p>
        <p>Job title: {{ $employee[6] }}</p>
        <p>Salary: {{ $employee[7] }}</p>
        
      </div>
    @endforeach
    @endif
    
</x-app-layout>
