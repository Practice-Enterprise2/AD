<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
</head>

<body>
  <h1 class="m-8 text-center text-3xl">Invoice Details</h1>

  <div class="mx-auto w-[810px] bg-white p-[10px]">
    <div class="mt-7">
      <h2 class="text-center">Customer Info:</h2>
    </div>
    <div class="flex border-2 border-solid">

      <div class="h-[150px] w-[200px]">
        <p>First Name: {{ $data['user']->name }}</p>

        <p>Last Name: {{ $data['user']->last_name }}</p>

        <p>Email: {{ $data['user']->email }}</p>

        <p>Phone: {{ $data['user']->phone }}</p>
      </div>
    </div>
    <h2 class="text-center">Invoice Info:</h2>
    <div class="flex border-2 border-solid">

      <div class="w-[200px]">
        <p>Invoice Code: {{ $data['invoice']->invoice_code }}</p>

        <p>Due Date: {{ $data['invoice']->due_date }}</p>

        <p>Total Price: {{ $data['invoice']->total_price }} Euro</p>

        <p>Total Price Excl VAT: {{ $data['invoice']->total_price_excl_vat }}
          Euro</p>

        <p>Payment Status: @if ($data['invoice']->is_paid == 0)
            NOT PAID
          @endif
          @if ($data['invoice']->is_paid == 1)
            PAID
          @endif
        </p>

        <p>Created At: {{ $data['invoice']->created_at }}</p>

      </div>
    </div>
    <h2 class="text-center">Shipment Details:</h2>

    <div class="flex border-2 border-solid">

      <div class="w-[196px] w-[200px]">
        <h2>Source Address:</h2>
        <p>Street: {{ $data['sourceAddress']->street }}</p>

        <p>House Number: {{ $data['sourceAddress']->house_number }}</p>

        <p>Potsal Code: {{ $data['sourceAddress']->postal_code }}</p>

        <p>City: {{ $data['sourceAddress']->city }}</p>

        <p>Region: {{ $data['sourceAddress']->region }}</p>

        <p>Country: {{ $data['sourceAddress']->country }}</p>
      </div>

      <div class="w-[196px] w-[200px]">
        <h2>Destination Address:</h2>
        <p>Street: {{ $data['destAddress']->street }}</p>

        <p>House Number: {{ $data['destAddress']->house_number }}</p>

        <p>Potsal Code: {{ $data['destAddress']->postal_code }}</p>

        <p>City: {{ $data['destAddress']->city }}</p>

        <p>Region: {{ $data['destAddress']->region }}</p>

        <p>Country: {{ $data['destAddress']->country }}</p>

      </div>

    </div>
    <div class="flex border-2 border-solid">

      <div class="w-[200px] w-[200px]">
        <p>Schipment Date: {{ $data['shipment']->shipment_date }}</p>

        <p>Delivery Date: {{ $data['shipment']->delivery_date }}</p>

        <p>Expense: {{ $data['shipment']->expense }}</p>

        <p>Weight: {{ $data['shipment']->weight }}</p>

        <p>Type: {{ $data['shipment']->type }}</p>

        <p>Created at: {{ $data['shipment']->created_at }}</p>

      </div>

      <div>
        <h2>Receiver:</h2>
        <p>Name: {{ $data['shipment']->receiver_name }}</p>

        <p>Email: {{ $data['shipment']->receiver_email }}</p>

      </div>

    </div>
    <h2 class="text-center">Dimensions:</h2>
    <div class="border-2 border-solid">

      <div class="float-left h-[150px] w-[200px]">
        <p>Length: {{ $data['dimensions']->length }}</p>

        <p>Width: {{ $data['dimensions']->width }}</p>

        <p>Height: {{ $data['dimensions']->height }}</p>

      </div>
    </div>
  </div>
</body>

</html>
