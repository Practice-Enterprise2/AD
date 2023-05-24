<x-app-layout>
  <style>
    body {
      background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
      main {
        padding-left: 240px;
      }
    }

    form,
    h1 {
      margin-left: 400px;
    }

    table {}

    th {
      margin: 20px;
    }

    td {
      padding: 20px;
    }

    tr:nth-child(2n) {
      background-color: lightgrey;
    }
    .nav-item{
      margin: 10px;
    }
   .sidebar{
    position: relative;
    float: left;
    margin-right: 20px;
   }
  </style>
  <div class="">
    <main style="margin-top: 20px">
    <div class="sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contract_list') }}">
                        -Contract List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('new_contract') }}">
                        -New Contract
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('edit_contract') }}">
                        -Edit Contract
                    </a>
                </li>
            </ul>
        </div>
    </div>
      <div class="container pt-4">
        <div class="">
          <h1 class="font-weight-bold"><b>Contract List</b></h1>

          <form action="contract_list" method="GET">
            @csrf
            <div>
              <p><label for="filter">Search contract:</label></p>
              <p><input type="text" id="filter" name="filter"
                  placeholder="contract ..."></p>
              <p><label for="active">active contracts:</label></p>
              <p><label for="c_active">active</label><input type="checkbox"
                  id="c_active" name="c_active"><label
                  for="c_inactive">inactive</label><input type="checkbox"
                  id="c_inactive" name="c_inactive"></p>

            </div>
            <button type="submit">Search</button>
          </form>
          <hr>
          <table border="1">
            <thead>
              <th>@sortablelink('contract_id', 'contractID')</th>
              <th>@sortablelink('airline_id', 'airlineID')</th>
              <th>@sortablelink('start_date', 'startdate')</th>
              <th>@sortablelink('end_date', 'enddate')</th>
              <th>@sortablelink('price', 'price')</th>
              <th>@sortablelink('depart_airport_id', 'depart location')</th>
              <th>@sortablelink('destination_airport_id', 'destination location')</th>
              <th>@sortablelink('created_at', 'Created at')</th>
              <th>@sortablelink('updated_at', 'Last updated')</th>
            </thead>
            <tbody>

              @foreach ($contracts as $contract)
                <tr>
                  <td>{{ $contract->id }}</td>
                  <td>{{ $contract->airline_id }}</td>
                  <td>{{ $contract->start_date }}</td>
                  <td>{{ $contract->end_date }}</td>
                  <td>{{ $contract->price }}</td>
                  <td>{{ $contract->depart_airport_id }}</td>
                  <td>{{ $contract->destination_airport_id }}</td>
                  <td>{{ $contract->created_at }}</td>
                  <td>{{ $contract->updated_at }}</td>
                  <td><a
                      href="{{ Route('contract_pdf', $contract->id) }}">PDF</a>
                  </td>

                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </main>
    <!--Main layout-->

  </div>
</x-app-layout>
