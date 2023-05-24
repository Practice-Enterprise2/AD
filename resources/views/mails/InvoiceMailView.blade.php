{{-- -*-html-*- --}}

<x-mail::message>

  Thank you for placing a shipment <b>{{ $data['name'] }}</b> ! <br><br>
  Your unique invoice code: <b>{{ $data['invoice_code'] }}</b> <br><br>
  Status: <b>PENDING</b><br><br>
  Weight: <br>
  <b>{{ $data['weight'] }}</b> kg <br><br>
  Price: <br>
  <b>{{ $data['total_price'] }}</b> EUR <br><br>

  Thanks,<br>
  <b>{{ config('app.name') }}</b>
</x-mail::message>
