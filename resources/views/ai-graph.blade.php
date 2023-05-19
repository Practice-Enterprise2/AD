<x-app-layout>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    .chart-container {
      height: 500px;
      width: 1000px;
    }
  </style>
  <script>
    var dates = <?php echo json_encode($dates); ?>;
    var orderCounts = <?php echo json_encode($ordercount); ?>;
    var today = new Date();
    today.setHours(0, 0, 0, 0);
    var backgroundColors = dates.map(function(date) {
      var Tdate = new Date(date);
      Tdate.setHours(0, 0, 0, 0);
      if (Tdate.getTime() === today.getTime()) {
        return 'rgb(255, 255, 255)';
      } else {
        return Tdate > today ? 'rgb(173, 216, 230)' : 'rgb(255, 99, 132)';
      }
    });
  </script>
  <div class="flex min-h-screen items-center justify-center">
    <div class="chart-container bg-white">
      <canvas id="AiChart"></canvas>
    </div>
  </div>
  <script>
    var ctx = document.getElementById('AiChart').getContext('2d');
    var AiChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: dates,
        datasets: [{
          label: 'Order Count',
          data: orderCounts,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
      options: {}
    });
  </script>
</x-app-layout>
