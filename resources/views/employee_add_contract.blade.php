{{-- -*-html-*- --}}

<x-app-layout>
  <script>
    function change() {
      var years = 0;

      var date1 = document.getElementById("startdate").value;
      var date2 = document.getElementById("stopdate").value;
      document.getElementById("extra").innerHTML = "";
      if (date1 && date2) {
        var date1Year = date1.substr(0, 4);
        var date2Year = date2.substr(0, 4);
        date1Year = parseInt(date1Year);
        date2Year = parseInt(date2Year);
        console.log(date1Year);
        console.log(date2Year);
        if (date1Year == date2Year) {
          years = 1;
        }
        if (date2Year > date1Year) {
          years = date2Year - date1Year + 1;
        }
        for (var i = 0; i < years; i++) {
          var Year = i + date1Year;
          document.getElementById("extra").innerHTML += '<label for="days' + i +
            '">amount vacation days for year ' + Year +
            ':</label><br><input type="number" name="days' + i +
            '" required><br>';
        }
      }
    }
  </script>
  <div class="m-auto w-2/5 bg-white text-center">
    <h1 class="p-8 text-center text-xl">New Employee Contract</h1>
    @if ($errors->any())
      <h2 class="text-xl text-red-600">{{ $errors->first() }}</h2>
    @endif
    @if (\Session::has('alert'))
      <h2 class="text-xl text-lime-400">{!! \Session::get('alert') !!}</h2>
    @endif
    <form method="post" action="{{ route('employee-add-contract') }}"
      accept-charset="UTF-8">
      @csrf
      <label for="employeeID">Select an employee:</label>
      <select name="employeeID" id="employeeID" required>
        @foreach ($users as $user)
          <option value="{{ $user['employeeID'] }}">{{ $user['name'] }}
            {{ $user['lastname'] }}</option>
        @endforeach
      </select>
      <br>
      <label for="position">For position/job title:</label>
      <input type="text" name="position" id="position"
        class="rounded border-2" required>
      <br>
      <label for="salary">Salary per month</label>
      <input type="number" name="salary" id="salary"
        class="rounded border-2" required>
      <br>

      <label for="startdate">Start date:</label>
      <input type="date" id="startdate" name="startdate" required
        onchange="change()"><br>
      <label for="stopdate">Stop date:</label>
      <input type="date" id="stopdate" name="stopdate" required
        onchange="change()"><br>

      <div id="extra">

      </div>

      <br>
      <a id="newemployee"
        class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
        href="{{ route('employee-view-contracts') }}">Back</a>
      <button type="reset"
        class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700">reset</button>
      <button type="submit"
        class="mb-2 mr-2 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700">Add</button>
    </form>
  </div>
</x-app-layout>
