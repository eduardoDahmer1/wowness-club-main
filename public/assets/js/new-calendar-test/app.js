import EventManager from './events/eventManager.js';
import EventRequestHandler from './events/eventRequestHandler.js';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        events: {
            url: '/api/calendar/events/recurrences/calendar',
            method: 'GET',
            extraParams: {
                recurrent: true // Add a parameter to distinguish recurrent events
            },
            failure: function () {
                alert('There was an error while fetching events!');
            }
        },
        eventColor: '#8EBF76',
        eventTextColor: '#333',
        eventTimeFormat: { hour: 'numeric', minute: '2-digit' },
        eventClick: function (info) {
            info.jsEvent.preventDefault();
            const event = info.event;
            EventManager.handleScheduleForm(event);
        }
    });

    calendar.render(); // Render the calendar when the modal is fully shown

    $(document).on('click', '#scheduleEventBtn', function () {
        const event = EventManager.getCurrentEvent();

        var scheduleEvent = {
            occurrenceId: event.id,
            eventId: event.extendedProps.parentEventId,
            title: event.title,
            start: event.start,
            end: event.end,
        };

        EventRequestHandler.scheduleEvent(scheduleEvent,
            function (response) {
                // Handle success (e.g., show a notification)
                console.log('Event scheduled:', response);

                // Refresh the calendar events after update
                calendar.refetchEvents();

                $('#calendarModal').modal('hide');
            },
            function (error) {
                // Handle error (e.g., display error message)
                console.error('Error scheduling event:', error);
            }
        );
    });
});
