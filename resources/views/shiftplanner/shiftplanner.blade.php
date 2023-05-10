<x-app-layout>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          dateClick: function(info) {
            window.location.href = "/shiftplanner/day/" + info.dateStr;
          },
          events: <?php echo json_encode($shifts); ?>.map(function (shift) {
            return {
              title: shift.position.name,
              start: shift.planned_start_time,
              end: shift.planned_end_time,
              employee: shift.employee.name,
            };
          }),
        });
        
        calendar.render();
      });
    </script>
  </head>
  <body>
    <div id='calendar' class="h-3/4 m-5"></div>
  </body>
</x-app-layout>
