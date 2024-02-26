document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        events: {
            url: '/api/calendar/events',
            method: 'GET',
            extraParams: {
                recurrent: true // Add a parameter to distinguish recurrent events
            },
            failure: function () {
                alert('There was an error while fetching events!');
            }
        },
        eventColor: '#333',
        eventTextColor: '#ffffff',
        eventTimeFormat: { hour: 'numeric', minute: '2-digit' },
        eventClick: function (info) {
            info.jsEvent.preventDefault();

            if (info.event.start.getDay() === 0 || info.event.start.getDay() === 6) {
                info.jsEvent.preventDefault(); // Prevent the default action (e.g., event click)
                return false;
            }

            var event = info.event;
            var startTime = event.start.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
            var endTime = event.end.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });

            // Display title, duration, and recurrence rule in the modal
            $('#modalTitle').html(event.title);
            $('#modalBody').html(`<p><strong>Start Time:</strong> ${startTime}</p><p><strong>End Time:</strong> ${endTime}</p>${event.extendedProps.description}`);
            $('#calendarModal').modal();
        },
        dateClick: function (info) {
            var date = info.date;
            var formattedDate = date.toLocaleDateString();

            // Display date in the modal
            $('#modalTitle').html('Day Details');
            $('#modalBody').html(`
              <p><strong>Date:</strong> ${formattedDate}</p>
              <form id="createEventForm" class="needs-validation" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                  <label for="title">Title:</label>
                  <input type="text" class="form-control" name="title" required>
                  <div class="invalid-feedback">Please enter a title.</div>
                </div>
  
                <div class="form-group">
                  <label for="start">Start Date/Time:</label>
                  <input type="datetime-local" class="form-control" name="start" required>
                  <div class="invalid-feedback">Please enter a start date/time.</div>
                </div>
  
                <div class="form-group">
                  <label for="end">End Date/Time:</label>
                  <input type="datetime-local" class="form-control" name="end" required>
                  <div class="invalid-feedback">Please enter an end date/time.</div>
                </div>
  
                <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea class="form-control" name="description"></textarea>
                </div>
  
                <div class="form-group">
                  <label for="recurrence">Recurrence:</label>
                  <select class="form-control" name="recurrence">
                    <option value="DAILY">Daily</option>
                    <option value="WEEKLY">Weekly</option>
                    <option value="MONTHLY">Monthly</option>
                    <option value="YEARLY">Yearly</option>
                  </select>
                </div>
  
                <button type="submit" class="btn btn-primary">Create Event</button>
              </form>
            `);
            $('#calendarModal').modal();
            
            // Handle form submission for event creation
            $('#createEventForm').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/api/calendar/events/create',
                    data: $(this).serialize(),
                    success: function (response) {
                        // Handle success (e.g., close modal, refresh calendar)
                        console.log('Event created:', response);
                        $('#calendarModal').modal('hide'); // Close the modal
                        calendar.refetchEvents(); // Refresh the calendar events
                    },
                    error: function (error) {
                        // Handle error (e.g., display error message)
                        console.error('Error creating event:', error);
                    },
                });
            });
        },
    });
    calendar.render();
});
