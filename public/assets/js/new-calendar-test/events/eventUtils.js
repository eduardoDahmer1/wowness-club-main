const EventUtils = {
    parseTime: function (event) {
        const offsetMinutes = event.getTimezoneOffset();
        const adjustedDate = new Date(event.getTime() - offsetMinutes * 60000);
        return adjustedDate.toISOString().slice(0, -5).replace("T", " ");
    }
}

export default EventUtils;
