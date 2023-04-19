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
          }
        });
        calendar.render();
      });
    </script>
  </head>
  <body>
    <div id='calendar' class="h-3/4"></div>
  </body>
</x-app-layout>