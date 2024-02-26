import EventUtils from './eventUtils.js';
import EventRender from './eventRender.js';
import removeEventRender from './removeEventRender.js';

function getScheduledEvents() {
    var storedEvents = sessionStorage.getItem('scheduledEvents');
    return storedEvents ? JSON.parse(storedEvents) : [];
}

const EventManager = {
    event: null,

    setCurrentEvent: function (event) {
        this.event = event;
    },

    getCurrentEvent: function () {
        return this.event;
    },

    handleScheduleForm: function (event) {

        var storedEventsParsed = getScheduledEvents();
        // Create a deep copy of the event object
        const scheduleEvent = JSON.parse(JSON.stringify(event));
        // Override specific properties
        scheduleEvent.start = EventUtils.parseTime(event.start);
        scheduleEvent.end = EventUtils.parseTime(event.end);

        this.setCurrentEvent(scheduleEvent);
        const { title, start, end } = scheduleEvent; // Destructure for cleaner code
        var hasColor = null;
        var testeEvents = storedEventsParsed.filter(obj => obj.occurrenceId == scheduleEvent.id);
        if (Object.keys(testeEvents).length > 0 || scheduleEvent.borderColor == '#FF7276') {
            hasColor = testeEvents.map(object => object.color)
            if (Object.keys(hasColor).length > 0 || scheduleEvent.borderColor == '#FF7276') {
                removeEventRender.scheduleForm({ title, startTime: start, endTime: end });
            } else {
                EventRender.scheduleForm({ title, startTime: start, endTime: end });
            }
        } else {
            EventRender.scheduleForm({ title, startTime: start, endTime: end });
        }
    },
}

export default EventManager;
