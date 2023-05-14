<x-app-layout>
  <x-slot:header>
    <h2
      class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('My Invoices') }}
    </h2>
  </x-slot:header>

  <x-content-layout>
  <div class="flex justify-center">
  <table>
    <tr class="border-2 border-black dark:border-white">
      <th class="border-2 border-black dark:border-white">Invoice code</th>
      <th class="border-2 border-black dark:border-white">Due date</th>
      <th class="border-2 border-black dark:border-white">Price</th>
      <th class="border-2 border-black dark:border-white">Price incl. VAT</th>
      <th class="border-2 border-black dark:border-white">Created at</th>
      <th class="border-2 border-black dark:border-white">Status</th>
    </tr>
    @foreach ($invoices as $invoice)
      <tr class="h-full border-2 border-black dark:border-white">
        <td class="border-2 border-black dark:border-white">
          {{ $invoice->invoice_code }}
        </td>
        <td class="border-2 border-black dark:border-white">{{ $invoice->due_date }}
        </td>
        <td class="border-2 border-black dark:border-white">{{ $invoice->total_price }}
        </td>
        <td class="border-2 border-black dark:border-white">{{ $invoice->total_price_excl_vat }}
        </td>
        <td class="border-2 border-black dark:border-white">{{ $invoice->created_at }}
        </td>
        <td class="border-2 border-black dark:border-white">
        @if( $invoice->is_paid == 0 )
        <button class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600" onclick="window.location.href = '{{ route('invoices.payment', ['id' => $invoice->id]) }}'" >Pay</button>
        @elseif ( $invoice->is_paid == 1 )
        <button class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">PDF</button>
        @endif
        </td>
      </tr>
    @endforeach
  </table>
</div>
  </x-content-layout>
</x-app-layout>
{{-- vim: ft=html
--}}
