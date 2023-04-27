<x-app-layout>
  <style>
    .userpanel {
      /* width: 650px; */
      max-width: 700px;
      background-color: white;
      padding: 25px;
      margin-top: 50px;
      margin-left: auto;
      margin-right: auto;
      overflow: auto;
      border-radius: 8px;
      box-shadow: 0px 0px 10px -1px rgba(158, 158, 158, 1);
    }

    #newemployeediv {
      margin-top: 40px;
      text-align: center;
      width: 100%;
    }

    .innerpanel1 {
      width: 325px;
      float: left;
    }

    .innerpanel2 {
      width: 324px;
      float: right;
    }

    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }

    #editButton {
      float: right;
    }

    .theEditButton {}
  </style>
  <div>
    <div id="newemployeediv">
      <a id="newemployee"
        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
        href="{{ route('employee.create') }}">new employee</a>
    </div>

    @if ($employees[0])
      @foreach ($employees as $employee)
        <div class="userpanel">
          <form method="post" action="employee_edit" accept-charset="UTF-8">
            <input type="hidden" name="employeeId" value="{{ $employee[0] }}">

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
            <div class="theEditButton" style="clear:right">
              <button type="submit" id="editButton"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Edit</button>
            </div>
          </form>
        </div>
      @endforeach
    @endif

</x-app-layout>
