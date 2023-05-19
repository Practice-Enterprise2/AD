<x-app-layout>
    <div class="flex-grow p-8 dark:bg-gray-900 dark:text-white">
        <h1 class="text-2xl font-bold mb-8">Dashboard</h1>    
        
        <div class="m-2">
            <button class="bg-gray-800 text-white font-bold py-2 px-4 rounded hover:bg-gray-700 transition duration-500 ease-in-out" >Request Shipment</button>
            <button class="bg-gray-800 text-white font-bold py-2 px-4 rounded hover:bg-gray-700 transition duration-500 ease-in-out">Shipment Overview</button>
        </div>

        <div class="flex mb-8">
          <div class="w-1/2 p-4 bg-gray-800 rounded shadow-lg mr-4 text-xl font-bold">
            <h1 class="p-4 text-white font-bold text-2xl underline">Amount of Shipments</h1>
            <div class="text-7xl font-bold text-center mt-12">{{ $countUser }} </div>
          </div>
          <div class="w-1/2 p-4 bg-gray-800 rounded shadow-lg mr-4">
            <div class="grid grid-cols-2 gap-2 text-sm">
                <h1 class="col-span-2 p-4 text-white font-bold text-2xl underline">Shipments per status</h1>
                
                <div class="mx-auto font-bold text-bold">
                  <div class="">Awaiting pickup:</div>
                </div>
                <div class="mx-auto">
                    <div class=""> {{ $countAwaPick }} </div>
                </div>

                <div class="mx-auto font-bold text-bold">
                    <div class="">Awaiting confirmation:</div>
                </div>
                <div class="mx-auto">
                    <div class="">{{$countAwaConf}}</div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">In Transit:</div>
                </div>
                <div class="mx-auto">
                    <div class="">{{$countInTran}}</div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Out for Delivery:</div>
                </div>
                <div class="mx-auto ">
                    <div class="">{{$countOutFDel}}</div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Delivered:</div>
                </div>
                <div class="mx-auto">
                    <div class=""> {{$countDelivered}} </div>
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
                    <div class=""> {{$countEx}}  </div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Deleted:</div>
                </div>
                <div class="mx-auto">
                    <div class="">{{$countDel}} </div>
                </div>
                
                <div class="mx-auto font-bold">
                    <div class="">Declined:</div>
                </div>
                <div class="mx-auto">
                    <div class=""> {{$countDec}}</div>
                </div>
              </div>
              
          </div>

    </div>
      
    <div class="flex mb-8">
        <div class="w-1/2 p-4 bg-gray-800 rounded shadow-lg mr-4">
            <h1 class="col-span-2 p-4 text-white font-bold text-2xl underline">Expense Chart</h1>
            <canvas id="barChart" class="w-1/4"></canvas>    
        </div>
    
        <div class="w-1/2 p-4 bg-gray-800 rounded shadow-lg">
            <h1 class="p-4 text-white font-bold text-2xl underline">Last 5 Shipments</h1>
            <div class="grid grid-cols-4 gap-4 border-b-2 border-black mb-4 p-1 text-center text-sm font-bold ">
                <div class="">Shipment Number</div>
                <div class="">Reciever name</div>
                <div class="">Expense</div>
                <div class="">Status</div>
            </div>
            @foreach ($latest as $data)
                <div class="grid grid-cols-4 gap-4 border-b-2 border-gray-600 my-2 p-1 text-center">
                    <div class=""> {{$data->id}} </div>
                    <div class=""> {{$data->receiver_name}} </div>
                    <div class=""> {{$data->expense}}$ </div>
                    <div class=""> {{$data->status}} </div>
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
