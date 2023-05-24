<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Your invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .invoice-code {
      font-size: 18px;
      font-weight: bold;
    }

    .section {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .section p {
      margin: 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    .total-row {
      font-weight: bold;
    }

    .status {
      color: green;
    }
  </style>
</head>

<body>
  <div class="container mx-auto px-4 py-8">
    <div class="mb-4 text-center">
      <h1 class="text-2xl font-bold">Invoice</h1>
      <p class="text-sm">Invoice Code: {{ $invoice['invoice_code'] }}</p>
    </div>
    <div class="mb-4 flex justify-between">
      <div>
        <p class="font-semibold">Due Date:</p>
        <p>{{ $invoice['due_date'] }}</p>
      </div>
      <div>
        <p class="font-semibold">Status:</p>
        <p class="status">PAID</p>
      </div>
      <div>
        <p class="font-semibold">Created At:</p>
        <p>{{ $invoice['created_at'] }}</p>
      </div>
    </div>
    <table class="w-full border-collapse">
      <thead>
        <tr>
          <th class="border px-4 py-2">Description</th>
          <th class="border px-4 py-2">&euro;</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td class="border px-4 py-2 font-semibold">Total Price (Excl. VAT)
          </td>
          <td class="border px-4 py-2 font-semibold">
            {{ $invoice['total_price_excl_vat'] }}</td>
        </tr>
        <tr>
          <td class="border px-4 py-2 font-semibold">Total Price (Incl. VAT)
          </td>
          <td class="border px-4 py-2 font-semibold">
            {{ $invoice['total_price'] }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</body>

</html>
