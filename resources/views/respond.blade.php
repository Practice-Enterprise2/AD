<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shift Planner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: function(info, successCallback) {
                    fetch('/shifts')
                        .then(response => response.json())
                        .then(data => {
                            var events = data.map(shift => {
                                return {
                                    title: shift.employee.firstName + ' ' + shift.employee.lastName,
                                    start: shift.planned_start_time,
                                    end: shift.planned_end_time
                                };
                            });

                            successCallback(events);
                        });
                },
                eventDidMount: function(info) {
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.title,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>