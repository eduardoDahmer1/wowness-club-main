const API_URL = '/api/calendar/events/schedule/calendar/';

const EventRequestHandler = {
    scheduleEvent: (scheduleEvent, successCallback, errorCallback) => {
        const ajaxOptions = {
            type: 'PUT',
            url: API_URL,
            data: JSON.stringify(scheduleEvent),
        };

        const ajaxPromise = new Promise((resolve, reject) => {
            $.ajax({
                ...ajaxOptions,
                success: resolve,
                error: reject,
            });
        });

        ajaxPromise.then(successCallback).catch(errorCallback);
    },
};

export default EventRequestHandler;
