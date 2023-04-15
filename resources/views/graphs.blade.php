<x-app-layout>

<style>
.chartBox{
    width: 770px;
    float: left;
}
</style>

<div class="overflow-x-auto flex justify-center">
  <div class="chartCard">
    <div class="chartBox">
      <canvas id="myChart"></canvas>
    </div>
  </div>
  <div class="chartCard">
    <div class="chartBox" >
      <canvas id="lineChart"></canvas>
    </div>
  </div>

  <?php
  $day = [];
  $shipments = [];  
  $con = new mysqli('localhost','root','','ad');
  $query = $con->query("
  SELECT shipment_date,COUNT(shipment_date) AS sales FROM shipments
     WHERE shipment_date > current_date - interval 7 day
     GROUP BY shipment_date
     ORDER BY shipment_date ASC;
  ");
  foreach ($query as $data) {
    $day[] = $data['shipment_date'];
    $shipments[] = $data['sales'];
  }
  ?>
</div>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
  <script>

  // setup 
  const data = {
    labels: <?php echo json_encode($day) ?>,
    datasets: [{
      label: 'Weekly shipments per day',
      data: <?php echo json_encode($shipments) ?>,
      backgroundColor: [
        'rgba(255, 26, 104, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(0, 0, 0, 0.2)'
      ],
      borderColor: [
        'rgba(255, 26, 104, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(0, 0, 0, 1)'
      ],
      borderWidth: 1
    }]
  };

  // config 
  const config = {
    type: 'bar',
    data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

  // render init block
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

    // config linechart 
    const configLine = {
    type: 'line',
    data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

    // render init block
    const lineChart = new Chart(
    document.getElementById('lineChart'),
    configLine
  );
  

  // Instantly assign Chart.js version
  const chartVersion = document.getElementById('chartVersion');
  chartVersion.innerText = Chart.version;
  </script>
  <div class="text-center pt-6">
<a href="./shipments"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</button></a>
</div>
  </div>
  

</x-app-layout>