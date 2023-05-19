<x-app-layout>
  <div class="flex-grow p-8 dark:bg-gray-900 dark:text-white">
    <h1 class="mb-8 text-2xl font-bold">Dashboard</h1>

    <div class="m-2">
      <a href="{{ url('/shipments/create') }}"><button
          class="rounded bg-gray-800 px-4 py-2 font-bold text-white transition duration-500 ease-in-out hover:bg-gray-700">Request
          Shipment</button></a>
      <a href="{{ url('/shipments') }}"><button
          class="rounded bg-gray-800 px-4 py-2 font-bold text-white transition duration-500 ease-in-out hover:bg-gray-700">Shipment
          Overview</button></a>
    </div>

    <div class="mb-8 flex">
      <div
        class="mr-4 w-1/2 rounded bg-gray-800 p-4 text-xl font-bold shadow-lg">
        <h1 class="p-4 text-2xl font-bold text-white underline">Amount of
          Shipments</h1>
        <div class="mt-12 text-center text-7xl font-bold">{{ $countUser }}
        </div>
      </div>
      <div class="mr-4 w-1/2 rounded bg-gray-800 p-4 shadow-lg">
        <div class="grid grid-cols-2 gap-2 text-sm">
          <h1 class="col-span-2 p-4 text-2xl font-bold text-white underline">
            Shipments per status</h1>

          <div class="text-bold mx-auto font-bold">
            <div class="">Awaiting pickup:</div>
          </div>
          <div class="mx-auto">
            <div class=""> {{ $countAwaPick }} </div>
          </div>

          <div class="text-bold mx-auto font-bold">
            <div class="">Awaiting confirmation:</div>
          </div>
          <div class="mx-auto">
            <div class="">{{ $countAwaConf }}</div>
          </div>

          <div class="mx-auto font-bold">
            <div class="">In Transit:</div>
          </div>
          <div class="mx-auto">
            <div class="">{{ $countInTran }}</div>
          </div>

          <div class="mx-auto font-bold">
            <div class="">Out for Delivery:</div>
          </div>
          <div class="mx-auto">
            <div class="">{{ $countOutFDel }}</div>
          </div>

          <div class="mx-auto font-bold">
            <div class="">Delivered:</div>
          </div>
          <div class="mx-auto">
            <div class=""> {{ $countDelivered }} </div>
          </div>

          <div class="mx-auto font-bold">
            <div class="">Held at location:</div>
          </div>
          <div class="mx-auto">
            <div class=""> {{ $countHaL }} </div>
          </div>

          <div class="mx-auto font-bold">
            <div class="">Exeption:</div>
          </div>
          <div class="mx-auto">
            <div class=""> {{ $countEx }} </div>
          </div>

          <div class="mx-auto font-bold">
            <div class="">Deleted:</div>
          </div>
          <div class="mx-auto">
            <div class="">{{ $countDel }} </div>
          </div>

          <div class="mx-auto font-bold">
            <div class="">Declined:</div>
          </div>
          <div class="mx-auto">
            <div class=""> {{ $countDec }}</div>
          </div>
        </div>

      </div>

    </div>

    <div class="mb-8 flex">
      <div class="mr-4 w-1/2 rounded bg-gray-800 p-4 shadow-lg">
        <h1 class="col-span-2 p-4 text-2xl font-bold text-white underline">
          Expense Chart</h1>
        <canvas id="barChart" class="w-1/4"></canvas>
      </div>

      <div class="w-1/2 rounded bg-gray-800 p-4 shadow-lg">
        <h1 class="p-4 text-2xl font-bold text-white underline">Last 5 Shipments
        </h1>
        <div
          class="mb-4 grid grid-cols-4 gap-4 border-b-2 border-black p-1 text-center text-sm font-bold">
          <div class="">Shipment Number</div>
          <div class="">Reciever name</div>
          <div class="">Expense</div>
          <div class="">Status</div>
        </div>
        @foreach ($latest as $data)
          <div
            class="my-2 grid grid-cols-4 gap-4 border-b-2 border-gray-600 p-1 text-center">
            <div class=""> {{ $data->id }} </div>
            <div class=""> {{ $data->receiver_name }} </div>
            <div class=""> {{ $data->expense }}$ </div>
            <div class=""> {{ $data->status }} </div>
          </div>
        @endforeach
      </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Bar Chart Script --}}
<script>
  var blockCtx = document.getElementById('barChart').getContext('2d');
  var blockLabels = @php echo json_encode($blockLabels); @endphp;
  var blockData = @php echo json_encode($blockData); @endphp;

  var chart = new Chart(blockCtx, {
    type: 'bar',
    data: {
      labels: blockLabels,
      datasets: [{
        label: 'Expense',
        data: blockData,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
