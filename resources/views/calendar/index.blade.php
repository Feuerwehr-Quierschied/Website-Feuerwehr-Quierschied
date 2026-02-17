<x-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-fire-red mb-8">Kalender</h1>

        <div class="relative rounded-xl bg-gray-800 p-6 shadow-lg shadow-red-950/30">
            <div id="calendar" class="calendar-public"></div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'de',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventSources: [
                    {
                        url: '{{ route("calendar.events") }}',
                        method: 'GET'
                    }
                ]
            });
            calendar.render();
        });
    </script>

    <style>
        /* Match site theme: fire-red accents, dark backgrounds */
        .calendar-public {
            --fc-border-color: rgba(251, 44, 54, 0.3);
            --fc-button-bg-color: #FB2C36;
            --fc-button-border-color: #FB2C36;
            --fc-button-hover-bg-color: #e0252e;
            --fc-button-hover-border-color: #e0252e;
            --fc-button-active-bg-color: #c61f27;
            --fc-button-active-border-color: #c61f27;
            --fc-today-bg-color: rgba(251, 44, 54, 0.15);
            --fc-event-bg-color: #FB2C36;
            --fc-event-border-color: #FB2C36;
        }
        .calendar-public .fc {
            font-family: "Instrument Sans", ui-sans-serif, system-ui, sans-serif;
        }
        .calendar-public .fc-theme-standard td,
        .calendar-public .fc-theme-standard th {
            border-color: rgba(255, 255, 255, 0.1);
        }
        .calendar-public .fc-col-header-cell {
            background: rgba(39, 42, 46, 0.5);
            color: #d1d5dc;
        }
        .calendar-public .fc-scrollgrid {
            background: #272a2e;
        }
        .calendar-public .fc-daygrid-day-number {
            color: #d1d5dc;
        }
        .calendar-public .fc-daygrid-day.fc-day-today {
            background: rgba(251, 44, 54, 0.1);
        }
        .calendar-public .fc-button {
            text-transform: capitalize;
        }
        .calendar-public .fc-toolbar-title {
            color: #fff;
            font-size: 1.5rem;
        }
    </style>
</x-layout>
