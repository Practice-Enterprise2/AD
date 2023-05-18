{{-- -*-html-*- --}}

<x-app-layout>
  <style>
    .tableCust {
      margin-top: 50px;
    }

    tr:hover {
      background-color: var(--lgrey);
      color: black;
    }

    input {
      color: black;
    }
  </style>
  <div class="tableContainer">
    <table class="tableCust">
      <thead>
        <tr>
          <th>Name</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Region</th>
          <th>Country</th>
          <th>Vat-number</th>

          <th>Action</th>
        </tr>
        <tr>
          <th><input type="text" id="searchInputName" onkeyup="filterTable()"
              placeholder="Search name"></th>
          <th><input type="text" id="searchInputLastName"
              onkeyup="filterTable()" placeholder="Search last name">
          </th>
          <th><input type="text" id="searchInputEmail"
              onkeyup="filterTable()" placeholder="Search email"></th>
          <th><input type="text" id="searchInputPhone"
              onkeyup="filterTable()" placeholder="Search phone"></th>

          <th><input type="text" id="searchInputAddress"
              onkeyup="filterTable()" placeholder="Search address">
          </th>
          <th><input type="text" id="searchInputRegion"
              onkeyup="filterTable()" placeholder="Search region"></th>
          <th><input type="text" id="searchInputCountry"
              onkeyup="filterTable()" placeholder="Search country">
          </th>

          <th><input type="text" id="searchInputVatNumber"
              onkeyup="filterTable()" placeholder="Search VAT number">
          </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            @isset($user->address)
              <td>{{ $user->address->street }}
                {{ $user->address->house_number }},{{ $user->address->postal_code }}
                {{ $user->address->city }}</td>
              <td>{{ $user->address->region }}</td>
              <td>{{ $user->address->country }}</td>
            @endisset
            <td>
              @if ($user->business_customer)
                {{ $user->business_customer->vat_number }}
              @else
              @endif
            </td>
            <td>
              <a href="{{ route('customer.edit', $user->id) }}"><button
                  style="border: solid 2px grey ;padding: 5px">Edit</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    function filterTable() {
      var inputName, inputLastName, inputEmail, inputPhone, inputAddress,
        inputRegion, inputCountry, inputVatNumber, filter, table, tr, td, i,
        txtValue;
      inputName = document.getElementById("searchInputName");
      inputLastName = document.getElementById("searchInputLastName");
      inputEmail = document.getElementById("searchInputEmail");
      inputPhone = document.getElementById("searchInputPhone");
      inputAddress = document.getElementById("searchInputAddress");
      inputRegion = document.getElementById("searchInputRegion");
      inputCountry = document.getElementById("searchInputCountry");
      inputVatNumber = document.getElementById("searchInputVatNumber");
      filterName = inputName.value.toUpperCase();
      filterLastName = inputLastName.value.toUpperCase();
      filterEmail = inputEmail.value.toUpperCase();
      filterPhone = inputPhone.value.toUpperCase();
      filterAddress = inputAddress.value.toUpperCase();
      filterRegion = inputRegion.value.toUpperCase();
      filterCountry = inputCountry.value.toUpperCase();
      filterVatNumber = inputVatNumber.value.toUpperCase();
      table = document.querySelector(".tableCust");
      tr = table.getElementsByTagName("tr");
      for (i = 1; i < tr.length; i++) {
        tdName = tr[i].getElementsByTagName("td")[0];
        tdLastName = tr[i].getElementsByTagName("td")[1];
        tdEmail = tr[i].getElementsByTagName("td")[2];
        tdPhone = tr[i].getElementsByTagName("td")[3];
        tdAddress = tr[i].getElementsByTagName("td")[4];
        tdRegion = tr[i].getElementsByTagName("td")[5];
        tdCountry = tr[i].getElementsByTagName("td")[6];
        tdVatNumber = tr[i].getElementsByTagName("td")[7];
        if (tdName || tdLastName || tdEmail || tdPhone || tdAddress || tdRegion ||
          tdCountry || tdVatNumber) {
          txtValueName = tdName.textContent || tdName.innerText;
          txtValueLastName = tdLastName.textContent || tdLastName.innerText;
          txtValueEmail = tdEmail.textContent || tdEmail.innerText;
          txtValuePhone = tdPhone.textContent || tdPhone.innerText;
          txtValueAddress = tdAddress.textContent || tdAddress.innerText;
          txtValueRegion = tdRegion.textContent || tdRegion.innerText;
          txtValueCountry = tdCountry.textContent || tdCountry.innerText;
          txtValueVatNumber = tdVatNumber.textContent || tdVatNumber.innerText;
          if (txtValueName.toUpperCase().indexOf(filterName) > -1 &&
            txtValueLastName.toUpperCase().indexOf(filterLastName) > -1 &&
            txtValueEmail.toUpperCase().indexOf(filterEmail) > -1 &&
            txtValuePhone.toUpperCase().indexOf(filterPhone) > -1 &&
            txtValueAddress.toUpperCase().indexOf(filterAddress) > -1 &&
            txtValueRegion.toUpperCase().indexOf(filterRegion) > -1 &&
            txtValueCountry.toUpperCase().indexOf(filterCountry) > -1 &&
            txtValueVatNumber.toUpperCase().indexOf(filterVatNumber) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>

</x-app-layout>
{{-- vim: ft=html
--}}
