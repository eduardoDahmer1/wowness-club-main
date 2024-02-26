const EventRender = {
    scheduleForm: function ({ title, startTime, endTime }) {
        const modalBody = $('#modalBody');

        modalBody.html(`
            <form id="scheduleEventForm" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="eventTitle">Title:</label>
                    <input type="text" class="form-control" id="eventTitle" value="${title}" required disabled>
                    <div class="invalid-feedback">Please enter a title.</div>
                </div>

                <div class="form-group">
                    <label for="eventStart">Start Date/Time:</label>
                    <input type="datetime-local" class="form-control" id="eventStart" value="${startTime}" required disabled>
                    <div class="invalid-feedback">Please enter a start date/time.</div>
                </div>

                <div class="form-group">
                    <label for="eventEnd">End Date/Time:</label>
                    <input type="datetime-local" class="form-control" id="eventEnd" value="${endTime}" required disabled>
                    <div class="invalid-feedback">Please enter an end date/time.</div>
                </div>

                <button type="button" class="btn btn-success" id="scheduleEventBtn">Schedule</button>
            </form>
        `);

        $('#calendarModal').modal('show');
    }
};

export default EventRender;
