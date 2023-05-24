<x-app-layout>
  <div class="container mx-auto mt-4">

    <div class="flex flex-wrap justify-between">
      <div class="bg-darkTheme_gray rounded-lgs h-fit w-full p-6">
        {{-- Shipment info  --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

          <div class="rounded-lg bg-white p-4 shadow-md">
            <h2 class="mb-2 text-lg font-medium">Name Customer</h2>
            <p class="font-bold text-gray-500">First And Last Name: <span
                class="font-thin"> {{ $data->name }} </span></p>
          </div>

          <div class="rounded-lg bg-white p-4 shadow-md">
            <h2 class="mb-2 text-lg font-medium">Addresses</h2>
            <p class="font-bold text-gray-500">Srouce Address: <span
                class="font-thin"> {{ $srcAddress->street }}
                {{ $srcAddress->house_number }} {{ $srcAddress->postal_code }}
                {{ $srcAddress->city }} {{ $srcAddress->country }} </span></p>
            <p class="font-bold text-gray-500">Destination Address: <span
                class="font-thin"> {{ $dstAddress->street }}
                {{ $dstAddress->house_number }} {{ $dstAddress->postal_code }}
                {{ $dstAddress->city }} {{ $dstAddress->country }} </span></p>
          </div>

          <div class="rounded-lg bg-white p-4 shadow-md">
            <h2 class="mb-2 text-lg font-medium">Dates</h2>
            <p class="font-bold text-gray-500">Shipment pLacement Date: <span
                class="font-thin"> {{ $data->delivery_date }} </span></p>
            <p class="font-bold text-gray-500">Shipment Delivery Date: <span
                class="font-thin"> {{ $data->shipment_date }} </span></p>
          </div>

          <div class="rounded-lg bg-white p-4 shadow-md">
            <h2 class="mb-2 text-lg font-medium">Status </h2>
            <p class="font-bold text-gray-500">Shipment Status: <span
                class="font-thin"> {{ $data->status }} </span></p>
          </div>

          <div class="rounded-lg bg-white p-4 shadow-md">
            <h2 class="mb-2 text-lg font-medium">Time Info</h2>
            <p class="font-bold text-gray-500">Created At: <span
                class="font-thin"> {{ $data->created_at }} </span></p>
            <p class="font-bold text-gray-500">Updated At: <span
                class="font-thin"> {{ $data->updated_at }} </span></p>
          </div>

          <div class="rounded-lg bg-white p-4 shadow-md">
            <h2 class="mb-2 text-lg font-medium">Shipment Info</h2>
            <p class="font-bold text-gray-500">Weight: <span class="font-thin">
                {{ $data->weight }} </span></p>
            <p class="font-bold text-gray-500">Expense: <span class="font-thin">
                {{ $data->expense }} </span></p>
            <p class="font-bold text-gray-500">Type: <span class="font-thin">
                {{ $data->type }} </span></p>
          </div>

        </div>
      </div>

      <div class="bg-darkTheme_gray rounded-lgs my-4 h-fit w-full p-6">
        <div class="-mx-4 flex flex-wrap">
          <div class="w-full px-4 md:w-1/2">
            <div class="rounded-lg bg-white shadow-lg">
              <div class="px-6 py-4">
                <div class="mb-2 text-xl font-bold">Box 1</div>
                <p class="text-base text-gray-700">Content for box 1</p>
              </div>
            </div>
          </div>

          <div class="w-full px-4 md:w-1/2">
            <div class="rounded-lg bg-white shadow-lg">
              <div class="px-6 py-4">
                <div class="mb-2 text-xl font-bold">Box 3</div>
                <p class="text-base text-gray-700">Content for box 3</p>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
</x-app-layout>
