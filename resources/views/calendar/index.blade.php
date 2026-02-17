<x-layout>
    <div class="max-w-7xl mx-auto px-4 py-6 sm:py-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-fire-red mb-6 sm:mb-8">Kalender</h1>

        <div class="relative rounded-xl bg-gray-800 p-4 sm:p-6 shadow-lg shadow-red-950/30">
            <div id="calendar" class="calendar-public"></div>
        </div>
    </div>

    <dialog id="event-modal" class="rounded-xl bg-gray-800 border border-gray-700 shadow-xl shadow-red-950/30 p-8 max-h-[90vh] overflow-y-auto backdrop:bg-black/60"
        aria-labelledby="event-modal-title" aria-describedby="event-modal-description">
        <div class="flex justify-between items-start gap-4 mb-2">
            <h2 id="event-modal-title" class="text-xl font-bold text-fire-red"></h2>
            <button type="button" onclick="document.getElementById('event-modal').close()"
                class="text-gray-400 hover:text-white transition-colors shrink-0"
                aria-label="Schließen">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="event-modal-datetime" class="text-sm text-gray-400 mb-4"></div>
        <div id="event-modal-description" class="text-gray-300 whitespace-pre-wrap text-base leading-relaxed"></div>
        <div class="mt-4 pt-4 border-t border-gray-600">
            <button type="button" onclick="document.getElementById('event-modal').close()"
                class="px-4 py-2 bg-fire-red hover:bg-red-600 text-white rounded-lg transition-colors">
                Schließen
            </button>
        </div>
    </dialog>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const eventModal = document.getElementById('event-modal');
            let lastNavClick = 0;
            const navDebounceMs = 200;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'de',
                buttonText: {
                    today: 'Heute',
                    month: 'Monat',
                    week: 'Woche',
                    day: 'Tag'
                },
                customButtons: {
                    prev: {
                        icon: 'chevron-left',
                        click: function() {
                            if (Date.now() - lastNavClick < navDebounceMs) return;
                            lastNavClick = Date.now();
                            calendar.prev();
                        }
                    },
                    next: {
                        icon: 'chevron-right',
                        click: function() {
                            if (Date.now() - lastNavClick < navDebounceMs) return;
                            lastNavClick = Date.now();
                            calendar.next();
                        }
                    }
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                eventSources: [
                    {
                        url: '{{ route("calendar.events") }}',
                        method: 'GET'
                    }
                ],
                eventClick: function(info) {
                    const title = info.event.title;
                    const description = info.event.extendedProps.description || '';
                    const start = info.event.start;
                    const end = info.event.end;
                    const fmt = new Intl.DateTimeFormat('de-DE', {
                        weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric',
                        hour: '2-digit', minute: '2-digit'
                    });
                    const fmtDate = new Intl.DateTimeFormat('de-DE', {
                        weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric'
                    });
                    let datetimeText = '';
                    if (info.event.allDay) {
                        datetimeText = fmtDate.format(start);
                        if (end) {
                            const endDate = new Date(end);
                            endDate.setDate(endDate.getDate() - 1);
                            datetimeText += ' – ' + fmtDate.format(endDate);
                        }
                    } else {
                        datetimeText = fmt.format(start);
                        if (end) datetimeText += ' – ' + fmt.format(end);
                    }
                    document.getElementById('event-modal-title').textContent = title;
                    document.getElementById('event-modal-datetime').textContent = datetimeText;
                    document.getElementById('event-modal-description').textContent = description || 'Keine Beschreibung vorhanden.';
                    eventModal.showModal();
                }
            });
            eventModal.addEventListener('click', function(e) {
                if (e.target === eventModal) eventModal.close();
            });
            calendar.render();
        });
    </script>

    <style>
        #event-modal::backdrop {
            background: rgba(0, 0, 0, 0.6);
        }
        #event-modal {
            position: fixed !important;
            inset: 0 !important;
            width: min(40rem, calc(100% - 2rem)) !important;
            min-width: min(40rem, calc(100% - 2rem)) !important;
            max-width: min(40rem, calc(100% - 2rem)) !important;
            height: fit-content !important;
            max-height: 90vh !important;
            margin: auto !important;
            transform: none !important;
        }
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

        /* Mobile: stack toolbar vertically so all buttons fit */
        @media (max-width: 640px) {
            .calendar-public .fc-toolbar.fc-header-toolbar {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }
            .calendar-public .fc-toolbar-chunk {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            .calendar-public .fc-toolbar-chunk:first-child {
                order: 2;
            }
            .calendar-public .fc-toolbar-chunk:nth-child(2) {
                order: 1;
            }
            .calendar-public .fc-toolbar-chunk:last-child {
                order: 3;
            }
            .calendar-public .fc-toolbar-title {
                font-size: 1.25rem;
            }
            .calendar-public .fc-button {
                padding: 0.35rem 0.6rem;
                font-size: 0.875rem;
            }
            .calendar-public .fc-col-header-cell-cushion,
            .calendar-public .fc-daygrid-day-number {
                font-size: 0.75rem;
            }
        }
    </style>
</x-layout>
