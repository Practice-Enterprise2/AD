<x-app-layout>

  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset='utf-8' />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js">
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.css'
      rel='stylesheet' />
    <script
      src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet"
      href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
      function getCurrentDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0');
        var day = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');

        var dateTime = year + '-' + month + '-' + day + ' ' + hours + ':' +
          minutes + ':' + seconds;
        return dateTime;
      }

      function getEmployeeIdByName(employees, name) {
        var employeeId = null;
        employees.forEach(function(employee) {
          if (employee.name === name) {
            employeeId = employee.id;
          }
        });
        return employeeId;
      }
      var employees = <?php echo json_encode(
          $shifts
              ->map(function ($shift) {
                  return [
                      'id' => $shift->employee->user->id,
                      'name' => $shift->employee->user->name,
                      'planned_start_time' => date('Y-m-d', strtotime($shift->planned_start_time)),
                      'planned_end-time' => date('Y-m-d', strtotime($shift->planned_end_time)),
                  ];
              })
              ->toArray(),
      ); ?>;

      var emps = <?php echo json_encode(
          $employees
              ->map(function ($emp) {
                  return [
                      'id' => $emp->id,
                      'name' => $emp->user->name,
                  ];
              })
              ->toArray(),
      ); ?>;

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          dateClick: function(info) {
            if (calendar.view.type === 'dayGridMonth') {
              // Go to week view of the clicked day
              calendar.changeView('timeGridWeek', info.dateStr);
            }
            if (calendar.view.type === 'timeGridWeek') {
              calendar.changeView('timeGridDay', info.dateStr)
            }
          },
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          editable: true,
          selectHelper: true,
          dayMaxEvents: true, // when too many events in a day, show the popover
          events: <?php echo json_encode(
              $shifts
                  ->map(function ($shift) {
                      return [
                          'title' => $shift->employee->user->name,
                          'start' => $shift->planned_start_time,
                          'end' => $shift->planned_end_time,
                      ];
                  })
                  ->toArray(),
          ); ?>,

          eventReceive: function(info) {
            var eventData = info.event;
            var droppedDate = eventData.start;
            var currentDate = new Date(); // Get the current date

            if (droppedDate < currentDate) {
              if (!confirm("Dropping an event in the past. Are you sure?")) {
                info.revert(); // Revert the drop
                return;
              }
            }
          },

          eventClick: function(info) {
            if (confirm("Are you sure you want to remove this event?")) {
              info.event.remove();

              // Send an AJAX request to delete the event from the server
              var formData = new FormData();
              formData.append('planned_start_time', moment(event.start)
                .format('YYYY-MM-DD HH:mm:ss'));
              formData.append('planned_end_time', moment(event.end)
                .format('YYYY-MM-DD HH:mm:ss'));
              formData.append('employee_id', getEmployeeIdByName(emps,
                event.title));

              fetch('/shifts/delete', {
                method: 'POST',
                body: formData,
                headers: {
                  'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]').getAttribute(
                    'content')
                }
              })
            }
          },
          eventDrop: function(info) {
            var eventData = info.event;
            var droppedDate = eventData.start;
            var currentDate = new Date(); // Get the current date

            if (droppedDate < currentDate) {
              if (!confirm("Dropping an event in the past. Are you sure?")) {
                info.revert(); // Revert the drop
                return;
              }
            }
          },

          eventResize: function(info) {
            if (!confirm("Confirm times?")) {
              info.revert();
            }
          }
        });
        calendar.render();
        var containerEl = document.getElementById('external-events');
        new FullCalendar.Draggable(containerEl, {
          itemSelector: '.fc-event',
          eventData: function(eventEl) {
            var title = eventEl.innerText.trim();
            var startTime =
          getCurrentDateTime(); // Set the start time in the format 'Y-M-D HH:MM:SS'
            event.startTime = startTime;
            //console.log(startTime);
            var endTime =
            ''; // Set the end time in the format 'Y-M-D HH:MM:SS'
            return {
              title: title,
              start: startTime,
              end: endTime
            };
          }
        });
        // Save button functionality
        document.getElementById('save-button').addEventListener('click',
          function() {
            var events = calendar.getEvents();
            events.forEach(function(event) {
              var formData = new FormData();
              formData.append('planned_start_time', moment(event.start)
                .format('YYYY-MM-DD HH:mm:ss'));
              formData.append('planned_end_time', moment(event.end)
                .format('YYYY-MM-DD HH:mm:ss'));
              formData.append('actual_start_time', null);
              formData.append('actual_end_time', null);
              formData.append('employee_id', getEmployeeIdByName(emps,
                event.title));
              formData.append('created_at', moment().format(
                'YYYY-MM-DD HH:mm:ss'));
              formData.append('updated_at', moment().format(
                'YYYY-MM-DD HH:mm:ss'));

              fetch('/shifts', {
                method: 'POST',
                body: formData,
                headers: {
                  'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]').getAttribute(
                    'content')
                }
              });
            });
          });
      });
    </script>
  </head>

  <body>
    <div class="flex flex-col md:flex-row md:space-x-4">
      <div class="md:w-1/4">
        <div id='external-events' class="rounded-md bg-white p-4">
          <p class="mb-2 font-semibold">
            <strong>Employees</strong>
          </p>
          @foreach ($employees as $employee)
            <div
              class='fc-event mb-2 cursor-move rounded-md bg-gray-100 p-2 hover:bg-gray-200'>
              {{ $employee->user->name }}</div>
          @endforeach
          <button id="save-button"
            class="mt-4 rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
            Save
          </button>
        </div>
      </div>
      <div class="md:flex-1">
        <div id='calendar-container' class="rounded-md bg-white p-4">
          <div id='calendar'></div>
        </div>
      </div>
    </div>
  </body>

</x-app-layout>
