<x-app-layout>
    <div class="flex-grow p-8 dark:bg-gray-900 dark:text-white">
        <h1 class="text-2xl font-bold mb-8">Dashboard</h1>
      
        <div class="flex mb-8">
          <div class="w-1/3 p-4 bg-gray-800 rounded shadow-lg mr-4 text-xl font-bold">
            <h1 class="p-4 text-white font-bold text-2xl underline">Amount of Shipments</h1>
            <div class="text-7xl font-bold text-center mt-12">{{ $countUser }} </div>
          </div>
          <div class="w-1/3 p-4 bg-gray-800 rounded shadow-lg mr-4">
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
          <div class="w-1/3 bg-gray-800 rounded shadow-lg text-lg font-bold">
            <h1 class="col-span-2 p-4 text-white font-bold text-2xl underline">Types</h1>
            <div>
                <canvas id="typeChart"></canvas>
            </div>
          </div>
        </div>
      
        <div class="flex mb-8">
          <div class="w-1/2 p-4 bg-gray-800 rounded shadow-lg mr-4">Panel 4</div>
          <div class="w-1/2 p-4 bg-gray-800 rounded shadow-lg">Panel 5</div>
        </div>
      
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
          var ctx = document.getElementById('typeChart').getContext('2d');
          var labels = <?php echo json_encode($labels); ?>;
          var data = <?php echo json_encode($data); ?>;
          
          var chart = new Chart(ctx, {
              type: 'pie',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Sales by Product',
                      data: data,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  legend: {
                      position: 'right',
                      labels: {
                          fontColor: '#333',
                          fontSize: 14
                      }
                  },
                  title: {
                      display: true,
                      text: 'Sales by Product',
                      fontColor: '#333',
                      fontSize: 18
                  }
              }
          });
      </script>
      

</x-app-layout>


