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
    @foreach ($users as $user)
      <div class="userpanel">

        <p>ID: {{ $user->id }}</p>
        <p>first name: {{ $user->firstName }}</p>
        <p>last name: {{ $user->lastName }}</p>
        <p>street: {{ $user->street }}</p>
        <p>province: {{ $user->province }}</p>
      </div>
    @endforeach
</x-app-layout>
