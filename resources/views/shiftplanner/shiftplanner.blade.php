<x-app-layout>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.css' rel='stylesheet' />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var shifts = <?= json_encode($shifts) ?>;
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          dateClick: function(info) {
            window.location.href = "/shiftplanner/day/" + info.dateStr;
          },
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          editable: true,
          dayMaxEvents: true, // when too many events in a day, show the popover
          events: <?php echo json_encode($shifts->map(function($shift) {
          return [
            'title' => $shift->employee->user->name ?? '',
            'start' => $shift->planned_start_time,
            'end' => $shift->planned_end_time,
          ];
          })->toArray());
          ?>,
          
          eventReceive: function(info) {
            info.event.setAllDay(true);
          },
          eventClick: function(info) {
            if(confirm("Are you sure you want to delete this event?")) {
              info.event.remove();
            }
          }
        });
        calendar.render();
        var containerEl = document.getElementById('external-events');
        new FullCalendar.Draggable(containerEl, {
          itemSelector: '.fc-event',
          eventData: function(eventEl) {
            return {
              title: eventEl.innerText.trim(),
              allDay: true
            };
          }
        });
      });
    </script>
  </head>

  <body>
    <div class="flex flex-col md:flex-row md:space-x-4">
      <div class="md:w-1/4">
        <div id='external-events' class="bg-white rounded-md p-4">
          <p class="font-semibold mb-2">
            <strong>Draggable Events</strong>
          </p>
          @foreach($employees as $employee)
            <div class='fc-event bg-gray-100 rounded-md p-2 mb-2 hover:bg-gray-200 cursor-move'>{{$employee->user->name}}</div>
          @endforeach
          <p class="mt-4">
            <input type='checkbox' id='drop-remove' />
            <label for='drop-remove'>remove after drop</label>
          </p>
        </div>
      </div>
      <div class="md:flex-1">
        <div id='calendar-container' class="bg-white rounded-md p-4">
          <div id='calendar'></div>
        </div>
      </div>
    </div>
  </body>
</x-app-layout>