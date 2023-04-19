import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [],
        eventDidMount: function(info) {
            // Add a tooltip with the employee's name
            var tooltip = new Tooltip(info.el, {
                title: info.event.title,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        }
    });

    // Fetch the shift data from the server
    fetch('/shifts')
        .then(response => response.json())
        .then(data => {
            // Map the data to FullCalendar events
            var events = data.map(shift => {
                return {
                    title: shift.employee.firstName + ' ' + shift.employee.lastName,
                    start: shift.planned_start_time,
                    end: shift.planned_end_time
                };
            });

            // Add the events to the calendar
            calendar.addEventSource(events);
        });

    calendar.render();
});