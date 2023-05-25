<x-app-layout>
  <x-slot name="header">
    <h2
      class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('My Invoices') }}
    </h2>
  </x-slot>

  <x-content-layout>
    <div class="flex justify-center">
      <table class="border-collapse">
        <thead>
          <tr class="bg-gray-200 dark:bg-gray-800">
            <th class="border-b border-gray-300 px-4 py-2 dark:border-gray-700">
              Invoice code</th>
            <th class="border-b border-gray-300 px-4 py-2 dark:border-gray-700">
              Due date</th>
            <th class="border-b border-gray-300 px-4 py-2 dark:border-gray-700">
              Price</th>
            <th class="border-b border-gray-300 px-4 py-2 dark:border-gray-700">
              Price excl. VAT</th>
            <th class="border-b border-gray-300 px-4 py-2 dark:border-gray-700">
              Created at</th>
            <th class="border-b border-gray-300 px-4 py-2 dark:border-gray-700">
              Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($invoices as $invoice)
            <tr class="border-b border-gray-300 dark:border-gray-700">
              <td class="px-4 py-2">{{ $invoice->invoice_code }}</td>
              <td class="px-4 py-2">{{ $invoice->due_date }}</td>
              <td class="px-4 py-2">{{ $invoice->total_price }}</td>
              <td class="px-4 py-2">{{ $invoice->total_price_excl_vat }}</td>
              <td class="px-4 py-2">{{ $invoice->created_at }}</td>
              <td class="px-4 py-2">
                @if ($invoice->is_paid == 0)
                  <button
                    class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                    onclick="window.location.href = '{{ route('invoices.payment', ['id' => $invoice->id]) }}'">
                    Pay
                  </button>
                @elseif ($invoice->is_paid == 1)
                  <button
                    class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                    onclick="window.location.href = '{{ route('createPDF', ['id' => $invoice->id]) }}'">
                    PDF
                  </button>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </x-content-layout>
</x-app-layout>
