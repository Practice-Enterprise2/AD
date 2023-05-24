{{-- -*-html-*- --}}

<x-app-layout>
  <div>
    <canvas id="myChart"></canvas>
    <canvas id="yearchart"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('myChart');
    window.addEventListener('load', function() {


      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
            'Sep', 'Oct', 'Nov', 'Dec'
          ],
          datasets: [{
            label: '# of employees this year',
            data: [
              @foreach ($countpm as $value)
                {{ $value }},
              @endforeach
            ],
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
    });
  </script>
  <script>
    window.addEventListener('load', function() {
      const cty = document.getElementById('yearchart');

      new Chart(cty, {
        type: 'line',
        data: {
          labels: [
            @for ($year = date('Y'); $year >= date('Y') - 4; $year--)
              {{ $year }},
            @endfor
          ],
          datasets: [{
            label: '# of employees over the last 5 year',
            data: [
              @foreach ($countpy as $value)
                {{ $value }},
              @endforeach
            ],
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
    });
  </script>
</x-app-layout>
