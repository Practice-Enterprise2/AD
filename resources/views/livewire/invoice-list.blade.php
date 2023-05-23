<div>
  <div class="m-8 mx-auto text-center">
    <input wire:model="search" type="text" class="mx-auto"
      placeholder="Search invoice code..." />
    <label for="isPaid">Is Paid:</label>
    <select wire:model="isPaid" id="isPaid">
      <option value="both">Both</option>
      <option value="yes">Yes</option>
      <option value="no">No</option>
    </select>
  </div>
  <div class="mx-auto">
    <table class="w-[1000px] border-2 border-solid text-center">
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Shipment ID</th>
      <th>Invoice Code</th>
      <th>Due Date</th>
      <th>Total Price</th>
      <th>Total Price Excl. VAT</th>
      <th>Is Paid</th>
      <th>Created At</th>
      @if (@isset($invoices))
        @foreach ($invoices as $invoice)
          <tr class="border-2 border-solid">
            <td>{{ $invoice['id'] }}</td>
            <td>{{ $invoice['name'] }}</td>
            <td>{{ $invoice['last_name'] }}</td>
            <td>{{ $invoice['shipment_id'] }}</td>
            <td>{{ $invoice['invoice_code'] }}</td>
            <td>{{ $invoice['due_date'] }}</td>
            <td>{{ $invoice['total_price'] }}</td>
            <td>{{ $invoice['excl_vat'] }}</td>
            <td>{{ $invoice['is_paid'] }}</td>
            <td>{{ $invoice['created_at'] }}</td>
            <td>
              <form method="post" action="invoices_list/details"
                accept-charset="UTF-8">
                @csrf
                <button type="submit" id="editButton"
                  class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Details</button>
  </div>
  <input type="hidden" name="invoiceID" value="{{ $invoice['id'] }}">
  </form>
  </td>
  </tr>
  @endforeach
  @endif
  </table>
</div>
</div>
