<x-app-layout>
  <script>
    function details(nr) {
      var rows = document.getElementsByClassName('rowinvoice' + nr);
      var butt = document.getElementById('detailsinvoice' + nr);
      if (butt.innerHTML == "Open Details") {

        for (let i = 0; i < rows.length; i++) {
          rows[i].classList.remove("hidden");
        }
        butt.innerHTML = "Close Details";
      } else {

        for (let i = 0; i < rows.length; i++) {
          rows[i].classList.add("hidden");
        }
        butt.innerHTML = "Open Details";
      }
    }
  </script>
  <h1 class="mb-8 mt-8 text-center text-xl">My Order History</h1>
  <div class="mx-auto mt-8 flex text-xl">

    <form action="order_history" method="get">
      <input type="text" name="query" placeholder="Search for invoice Code..">
      <button type="submit">Search</button>
    </form>
    &nbsp;&nbsp;<a href="{{ route('order-history') }}">View All</a>
  </div>
  <table class="mx-auto mt-8 w-[1000px]">
    @if (@isset($data))
      @foreach ($data as $d)
        <tr class="bg-white">
          <td class="p-[40px]">Invoice Code: {{ $d[1]->invoice_code }}</td>
          <td class="p-[40px]">Due Date: {{ $d[1]->due_date }}</td>
          <td class="p-[40px]">Total Price: {{ $d[1]->total_price }}</td>
          <td class="p-[40px]">Total Price Excl VAT:
            {{ $d[1]->total_price_excl_vat }}</td>
          @if ($d[1]->is_paid == 0)
            <td class="text-red-600">Payment Status:<br> NOT PAID</td>
          @endif
          @if ($d[1]->is_paid == 1)
            <td class="text-green-500">Payment Status:<br> PAID</td>
          @endif
          <td>
            <button id="detailsinvoice{{ $d[4] }}"
              onclick="details({{ $d[4] }})"
              class="border-2 bg-slate-300 p-8">Open Details</button>
          </td>
        </tr>

        <tr class="rowinvoice{{ $d[4] }} hidden bg-slate-300">
          <td colspan="6" class="p-[40px]">
            <div>
              <div>
                <p>Source address:</p> {{ $d[2]->street }}
                {{ $d[2]->house_number }}, {{ $d[2]->postal_code }}
                {{ $d[2]->city }} {{ $d[2]->region }} {{ $d[2]->country }}
              </div>
              <br>
              <div>
                <p>Destination address:</p> {{ $d[3]->street }}
                {{ $d[3]->house_number }}, {{ $d[3]->postal_code }}
                {{ $d[3]->city }} {{ $d[3]->region }} {{ $d[3]->country }}
              </div>
              <br>
              <div>
                <p>Receiver:</p>
                <p>Name: {{ $d[0]->receiver_name }}</p>
                <p>Name: {{ $d[0]->receiver_email }}</p>
              </div>
              <br>
              <div>
                <p>Shipment date: {{ $d[0]->shipment_date }}</p>
                <p>Delivery date: {{ $d[0]->delivery_date }}</p>
              </div>
              <br>
              <div>
                <p>Expense: {{ $d[0]->expense }}</p>
                <p>Weight: {{ $d[0]->weight }}</p>
                <p>Type: {{ $d[0]->type }}</p>
              </div>
              <br>
              <div>
                <p>Dimensions:</p>
                <p>Length: {{ $d[5]->length }}</p>
                <p>Width: {{ $d[5]->width }}</p>
                <p>Height: {{ $d[5]->height }}</p>
              </div>
            </div>
          </td>

        </tr>
        <tr class="rowinvoice{{ $d[4] }} hidden">

        </tr>
      @endforeach
    @endif

  </table>

</x-app-layout>
