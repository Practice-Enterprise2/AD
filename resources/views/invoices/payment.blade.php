<x-app-layout>
  <div class="container mx-auto py-8 text-black">
    <form method="GET"
      action='{{ route('invoices.payment_success', ['id' => $invoice->id]) }}'
      class="mx-auto max-w-md bg-white p-8 shadow-md">
      @csrf
      <h1 class="mb-4 text-2xl font-bold">Select Payment Method</h1>
      <div class="mb-4">
        <label class="inline-flex items-center">
          <input type="radio" id="creditCard" name="payment_method"
            value="credit_card" checked class="form-radio">
          <span class="ml-2">Credit Card</span>
          <img src="{{ asset('images/visa.png') }}" alt="Credit card"
            class="ml-4 h-6">
        </label>
      </div>
      <div class="mb-4">
        <label class="inline-flex items-center">
          <input type="radio" id="paypal" name="payment_method"
            value="paypal" class="form-radio">
          <span class="ml-2">PayPal</span>
          <img src="{{ asset('images/paypalLogo.png') }}" alt="PayPal"
            class="ml-4 h-6">
        </label>
      </div>
      <div class="mb-4">
        <label class="inline-flex items-center">
          <input type="radio" id="bancontact" name="payment_method"
            value="bancontact" class="form-radio">
          <span class="ml-2">Bancontact</span>
          <img src="{{ asset('images/bancontactLogo.png') }}" alt="Bancontact"
            class="ml-4 h-6">
        </label>
      </div>
      <h2 class="mb-2 text-xl font-bold">Price: &euro;
        {{ $invoice->total_price_excl_vat }}</h2>
      <h3 class="mb-4 text-lg">Price (incl. VAT): &euro;
        {{ $invoice->total_price }}</h3>
      <button type="submit"
        class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">Pay
        Now</button>
    </form>
  </div>

</x-app-layout>
