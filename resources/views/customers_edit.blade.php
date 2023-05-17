{{-- -*-html-*- --}}

<x-app-layout>
  <style>
    :root {
      --lgrey: #e0e0e0;
      --eLgrey: #f9f9f9;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .mini-container {
      max-width: 500px;
      width: 100%;
      padding: 20px;
      box-sizing: border-box;
    }

    @media (max-width: 767px) {
      .container {
        padding: 0 10px;
      }
    }

    h1 {
      font-size: 30px;
    }

    td {
      width: 10%;
      height: 20px;
    }

    input {
      width: 100%;
      border: black solid 1px;
      color: black;
    }

    tr {
      height: 50px;
    }
  </style>

  <div class="container">

    <div class="mini-container">
      <h1>Edit Customer</h1>
      <form action="{{ route('customer.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
          <tr>
            <td><label for="name">Name</label></td>
            <td>
              <input type="text" name="name" id="name"
                value="{{ $customer->name }}" pattern="[A-Za-z]+" required>
              @error('name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="last_name">Last Name</label></td>
            <td>
              <input type="text" name="last_name" id="last_name"
                value="{{ $customer->last_name }}" pattern="[A-Za-z]+" required>
              @error('last_name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" name="email" id="email"
                value="{{ $customer->email }}" readonly
                style="background-color: darkgrey;"></td>
          </tr>
          <tr>
            <td><label for="phone">Phone</label></td>
            <td>
              <input type="text" name="phone" id="phone"
                value="{{ $customer->phone }}" pattern="[0-9]+" required>
              @error('phone')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="street">Street</label></td>
            <td>
              <input type="text" name="street" id="street"
                value="{{ $customer->address->street ?? '' }}" required>
              @error('street')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="house_number">House Number</label></td>
            <td>
              <input type="text" name="house_number" id="house_number"
                value="{{ $customer->address->house_number ?? '' }}"
                pattern="[0-9]+" required>
              @error('house_number')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="postal_code">Postal Code</label></td>
            <td>
              <input type="text" name="postal_code" id="postal_code"
                value="{{ $customer->address->postal_code ?? '' }}" required>
              @error('postal_code')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="city">City</label></td>
            <td>
              <input type="text" name="city" id="city"
                value="{{ $customer->address->city ?? '' }}" required>
              @error('city')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="region">Region</label></td>
            <td>
              <input type="text" name="region" id="region"
                value="{{ $customer->address->region ?? '' }}" required>
              @error('region')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="country">Country</label></td>
            <td>
              <input type="text" name="country" id="country"
                value="{{ $customer->address->country ?? '' }}" required>
              @error('region')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </td>
          </tr>

          <tr id="vat_number_row">
            <td><label for="vat_number">VAT Number</label></td>
            <td>
              <input type="text" name="vat_number" id="vat_number" readonly
                style="background-color: darkgrey;"
                value="{{ $customer->business_customer ? $customer->business_customer->vat_number : '' }}"
                {{ $customer->business_customer && $customer->business_customer->vat_number ? 'required' : '' }}>

            </td>
          </tr>

          <tr>
            <td colspan="2"
              style="text-align: center;background-color: var(--lgrey);"><button
                type="submit">Update</button></td>
          </tr>

        </table>
      </form>
    </div>
  </div>
  <script type="module">
    $(document).ready(function() {
      // Hide the VAT Number <tr> initially if "Single" is selected
      if ($('#single').prop('checked')) {
        $('#vat_number_row').hide();
      }

      // Add an event listener to the radio buttons
      $('input[name="customer_type"]').change(function() {
        if ($('#single').prop('checked')) {
          // If "Single" is selected, hide the VAT Number <tr>
          $('#vat_number_row').hide();
        } else {
          // If "Business" is selected, show the VAT Number <tr>
          $('#vat_number_row').show();
        }
      });
    });
  </script>
</x-app-layout>
