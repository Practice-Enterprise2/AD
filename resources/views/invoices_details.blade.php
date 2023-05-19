<x-app-layout>

  <h1 class="m-8 text-center text-3xl">Invoice Details</h1>
  <div class="mx-auto mb-8 flex">
    <a href="{{ route('invoice-list') }}"
      class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-center text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Back</a>
    @if ($data['invoice']->is_paid == 0)
      <div>
        &nbsp;
      </div>
      <form method="get" action="{{ route('invoice-mail') }}"
        accept-charset="UTF-8">
        <input type="hidden" name="invoiceID" value="{{ $data['invoice']->id }}">
        <button type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">Resend
          Invoice Email
        </button>
      </form>
    @endif
    @if (\Session::has('success'))
      {!! \Session::get('success') !!}
    @endif

  </div>
  <div class="mx-auto w-[810px] bg-white p-[10px]">
    <div class="mt-7">
      <h2 class="text-center">Customer Info:</h2>
    </div>
    <div class="flex border-2 border-solid">

      <div class="h-[150px] w-[200px]">
        <p>First Name:</p>
        <p>Last Name:</p>
        <p>Email:</p>
        <p>Phone:</p>
      </div>
      <div class="">
        <p>{{ $data['user']->name }}&nbsp;</p>
        <p>{{ $data['user']->last_name }}&nbsp;</p>
        <p>{{ $data['user']->email }}&nbsp;</p>
        <p>{{ $data['user']->phone }}&nbsp;</p>
      </div>
    </div>
    <h2 class="text-center">Invoice Info:</h2>
    <div class="flex border-2 border-solid">

      <div class="w-[200px]">
        <p>Invoice Code:</p>
        <p>Due Date:</p>
        <p>Total Price:</p>
        <p>Total Price Excl VAT:</p>
        <p>Payment Status:</p>
        <p>Created At:</p>
      </div>
      <div class="">
        <p>{{ $data['invoice']->invoice_code }}</p>
        <p>{{ $data['invoice']->due_date }}</p>
        <p>{{ $data['invoice']->total_price }} Euro</p>
        <p>{{ $data['invoice']->total_price_excl_vat }} Euro</p>
        @if ($data['invoice']->is_paid == 0)
          <p class="text-red-600">NOT PAID</p>
        @endif
        @if ($data['invoice']->is_paid == 1)
          <p class="text-green-600">PAID</p>
        @endif

        <p>{{ $data['invoice']->created_at }}</p>
      </div>
    </div>
    <h2 class="text-center">Shipment Details:</h2>

    <div class="flex border-2 border-solid">

      <div class="w-[196px] w-[200px]">
        <p>Source Address:</p>
        <p>Street:</p>
        <p>House Number:</p>
        <p>Potsal Code:</p>
        <p>City:</p>
        <p>Region:</p>
        <p>Country:</p>
      </div>
      <div class="w-[196px] w-[200px]">
        <p>&nbsp;</p>
        <p>{{ $data['sourceAddress']->street }}</p>
        <p>{{ $data['sourceAddress']->house_number }}</p>
        <p>{{ $data['sourceAddress']->postal_code }}</p>
        <p>{{ $data['sourceAddress']->city }}</p>
        <p>{{ $data['sourceAddress']->region }}</p>
        <p>{{ $data['sourceAddress']->country }}</p>

      </div>
      <div class="w-[196px] w-[200px]">
        <p>Destination Address:</p>
        <p>Street:</p>
        <p>House Number:</p>
        <p>Potsal Code:</p>
        <p>City:</p>
        <p>Region:</p>
        <p>Country:</p>
      </div>
      <div class="w-[196px] w-[200px]">
        <p>&nbsp;</p>
        <p>{{ $data['destAddress']->street }}</p>
        <p>{{ $data['destAddress']->house_number }}</p>
        <p>{{ $data['destAddress']->postal_code }}</p>
        <p>{{ $data['destAddress']->city }}</p>
        <p>{{ $data['destAddress']->region }}</p>
        <p>{{ $data['destAddress']->country }}</p>

      </div>

    </div>
    <div class="flex border-2 border-solid">

      <div class="w-[200px] w-[200px]">
        <p>Schipment Date:</p>
        <p>Delivery Date:</p>
        <p>Expense:</p>
        <p>Weight:</p>
        <p>Type:</p>
        <p>Created at:</p>
      </div>
      <div class="w-[200px] w-[600px]">

        <p>{{ $data['shipment']->shipment_date }}</p>
        <p>{{ $data['shipment']->delivery_date }}</p>
        <p>{{ $data['shipment']->expense }}</p>
        <p>{{ $data['shipment']->weight }}</p>
        <p>{{ $data['shipment']->type }}</p>
        <p>{{ $data['shipment']->created_at }}</p>

      </div>

      <div class="">
        <p>Receiver:</p>
        <p>Name:</p>
        <p>Email</p>
      </div>
      <div class="">
        <p>&nbsp;</p>
        <p>{{ $data['shipment']->receiver_name }}</p>
        <p>{{ $data['shipment']->receiver_email }}</p>
      </div>

    </div>
    <h2 class="text-center">Dimensions:</h2>
    <div class="border-2 border-solid">

      <div class="float-left h-[150px] w-[200px]">
        <p>Length:</p>
        <p>Width:</p>
        <p>Height:</p>

      </div>
      <div class="">
        <p>{{ $data['dimensions']->length }}&nbsp;</p>
        <p>{{ $data['dimensions']->width }}&nbsp;</p>
        <p>{{ $data['dimensions']->height }}&nbsp;</p>

      </div>
    </div>
  </div>

</x-app-layout>
