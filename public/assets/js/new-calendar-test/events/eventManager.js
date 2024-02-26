import EventUtils from './eventUtils.js';
import EventRender from './eventRender.js';

const EventManager = {
    event: null,

    setCurrentEvent: function (event) {
        this.event = event;
    },

    getCurrentEvent: function () {
        return this.event;
    },

    handleScheduleForm: function (event) {
        // Create a deep copy of the event object
        const scheduleEvent = JSON.parse(JSON.stringify(event));

        // Override specific properties
        scheduleEvent.start = EventUtils.parseTime(event.start);
        scheduleEvent.end = EventUtils.parseTime(event.end);

        this.setCurrentEvent(scheduleEvent);

        const { title, start, end } = scheduleEvent; // Destructure for cleaner code

        EventRender.scheduleForm({ title, startTime: start, endTime: end });
    },
}

export default EventManager;
