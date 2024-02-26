import EventManager from "./events/eventManager.js";
import EventRequestHandler from "./events/eventRequestHandler.js";

document.addEventListener("DOMContentLoaded", function () {
    localStorage.removeItem('currentDate')
    let calendar = null; // Declare the calendar variable outside the initialization function
    let currentEvent = null; // Declare the currentEvent variable outside the initialization function
    let usedPackages = [];
    const typeValue = $("#type-value").val();

    // Function to initialize the calendar with the given packageId
    function initializeCalendar(packageId) {
        calendar = new FullCalendar.Calendar(
            document.getElementById("calendar"),
            {
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay",
                },
                initialView: "dayGridMonth",
                events: {
                    url: "/api/calendar/events/recurrences/calendar",
                    method: "GET",
                    extraParams: {
                        packageId: packageId,
                        recurrent: true,
                    },
                    failure: function () {
                        alert("There was an error while fetching events!");
                    },
                },
                eventColor: "#8EBF76",
                eventTextColor: "#333",
                eventTimeFormat: { hour: "numeric", minute: "2-digit" },
                eventClick: function (info) {
                    info.jsEvent.preventDefault();
                    const event = info.event;
                    currentEvent = event;
                    EventManager.handleScheduleForm(event);
                },
            }
        );

        $("#exampleModal").on("shown.bs.modal", function () {
            calendar.render();
        });
    }

    // Function to update the calendar events based on the selected radio button
    function updateCalendarEvents(packageId) {
        var storedEvents = sessionStorage.getItem("scheduledEvents");
        if (calendar) {
            // Get the list of scheduled events
            const scheduledEvents = getScheduledEvents();

            calendar.getEventSources().forEach(function (eventSource) {
                eventSource.remove();
            });

            // Refetch events with the updated extraParams
            calendar.addEventSource({
                url: "/api/calendar/events/recurrences/calendar",
                method: "GET",
                extraParams: {
                    packageId: packageId,
                    recurrent: true,
                    storedEvents: storedEvents,
                },
                success: function (events) {
                    const filteredEvents = events.filter((event) => {
                        const isScheduled = scheduledEvents.some(
                            (scheduledEvent) =>
                                scheduledEvent.occurrenceId === event.id
                        );
                        if (isScheduled) {
                            console.log("Event already scheduled:", event);
                        }
                    });
                },
            });
        }
    }

    $("#modal-calendar-open").on("click", function () {
        const packageId = document.querySelector(
            'input[name="package_id"]:checked'
        ).value;

        if (!calendar) {
            // If calendar is not initialized, initialize it with the default packageId
            document.getElementById("exampleModal").style.display = "block";
            initializeCalendar(packageId);
        } else {
            // If calendar is already initialized, update the events with the selected packageId
            document.getElementById("exampleModal").style.display = "block";
            updateCalendarEvents(packageId);
        }

        $("#exampleModal").modal("show");
    });

    function updateTotalPrice() {
        var packagePrice = parseFloat(
            document
                .querySelector('input[name="package_id"]:checked')
                .getAttribute("data-price")
        );
        var currentTotalPrice = parseFloat(
            document.getElementById("total-price").textContent
        );

        var newTotalPrice = currentTotalPrice + packagePrice;

        document.getElementById("total-price").textContent =
            newTotalPrice.toFixed(2);
    }

    function decrementTotalPrice() {
        var packagePrice = parseFloat(
            document
                .querySelector('input[name="package_id"]:checked')
                .getAttribute("data-price")
        );
        var currentTotalPrice = parseFloat(
            document.getElementById("total-price").textContent
        );

        var newTotalPrice = currentTotalPrice - packagePrice;

        document.getElementById("total-price").textContent =
            newTotalPrice.toFixed(2);
    }

    function getScheduledEvents() {
        var storedEvents = sessionStorage.getItem("scheduledEvents");
        return storedEvents ? JSON.parse(storedEvents) : [];
    }

    const handleMultipleDates = () => {
        const eventData = getScheduledEvents();

        const dates = eventData.map((event) => {
            const dateOptions = {
                month: "short",
                day: "numeric",
                year: "numeric",
                hour: "numeric",
                minute: "2-digit",
                hour12: true,
            };

            const startFormatted = new Date(event.start)
            const endFormatted = new Date(event.end)

            var diffMinutes = diff_minutes(startFormatted, endFormatted);
            var durationType;
            var duration;
            var convertedDuration

            document.querySelectorAll('.sub-check-options').forEach((value) => {
                let input = value.firstElementChild
                if (input.checked) {
                    duration = input.getAttribute('data-duration');
                    durationType = input.getAttribute('data-type');
                    if (duration) {
                        if (durationType == 2) {
                            convertedDuration = duration * 60;
                        } else {
                            convertedDuration = duration;
                        }

                        if (convertedDuration < diffMinutes) {
                            endFormatted.setMinutes(endFormatted.getMinutes() - (diffMinutes - convertedDuration))
                        }
                    }
                }
            });

            const newStarFormatted = new Date(startFormatted).toLocaleString(
                "en-US",
                dateOptions
            );
            const newEndFormatted = new Date(endFormatted).toLocaleString(
                "en-US",
                dateOptions
            );

            return `${newStarFormatted} - ${newEndFormatted}`;
        });

        localStorage.setItem(
            "currentDate",
            JSON.stringify({ dates: dates, typeValue })
        );
    };

    function diff_minutes(dt2, dt1) {
        var diff = (dt2.getTime() - dt1.getTime()) / 1000;
        diff /= (60 * 60);
        return Math.abs(diff * 60);
    }

    function updateScheduledEvents(newEvent) {
        return new Promise(function (resolve) {
            var scheduledEvents = getScheduledEvents();

            scheduledEvents.push(newEvent);
            sessionStorage.setItem(
                "scheduledEvents",
                JSON.stringify(scheduledEvents)
            );

            handleMultipleDates();
            resolve();
        });
    }

    // function removeScheduledEvent(event) {
    //     return new Promise(function (resolve) {
    //         sessionStorage.removeItem('scheduledEvents', JSON.stringify(scheduledEvents))
    //     })
    // }
    $(document).on("click", "#scheduleEventBtn", function () {
        // Increment the quantity value
        var quantityInput = document.getElementById("quantity");
        quantityInput.value = parseInt(quantityInput.value, 10) + 1;

        // Update the Total Price
        updateTotalPrice();

        const event = EventManager.getCurrentEvent();

        var scheduleEvent = {
            occurrenceId: event.id,
            eventId: event.extendedProps.parentEventId,
            title: event.title,
            start: event.start,
            end: event.end,
            color: "#FF7276",
        };

        // Update the array of scheduled events in sessionStorage
        updateScheduledEvents(scheduleEvent)
            .then(function () {
                console.log("Event scheduled:", scheduleEvent);

                const packageId = document.querySelector(
                    'input[name="package_id"]:checked'
                ).value;
                const elementPackage = Array.from(
                    document.querySelectorAll('input[name="package_id"]')
                );

                elementPackage.forEach((element) => {
                    element.addEventListener("change", () => {
                        sessionStorage.removeItem("scheduledEvents");
                        $("#warning-book-now").prop("hidden", false);
                        $("#submitBookingForm").prop("hidden", true);
                        $(".terms").prop("hidden", true);
                    });
                });

                console.log(packageId);
                const idExists = usedPackages.some(
                    (packageObj) => packageObj.id === packageId
                );
                if (!idExists) {
                    let newPackage = {
                        id: packageId,
                        count: 1,
                    };
                    usedPackages.push(newPackage);
                }

                if (idExists) {
                    usedPackages.forEach((packageObj) => {
                        if (packageObj.id === packageId) {
                            packageObj.count++;
                        }
                    });
                }

                currentEvent.setProp("color", "#FF7276"); // Assuming FullCalendar version 3

                // Hide the calendar modal
                $("#calendarModal").modal("hide");
                document.getElementById("messageSuccess").innerHTML =
                    "Event " + event.title + " scheduled successfully !!";
            })
            .catch(function (error) {
                console.error("Error scheduling event:", error);
            });
    });

    $(document).on("click", "#removeScheduleBtn", function () {
        var quantityInput = document.getElementById("quantity");
        quantityInput.value = parseInt(quantityInput.value, 10) + 1;
        decrementTotalPrice();
        const event = EventManager.getCurrentEvent();
        var scheduledEvents = getScheduledEvents();
        sessionStorage.removeItem("scheduledEvents");
        scheduledEvents = scheduledEvents.filter(
            (obj) =>
                obj.occurrenceId !== event.id &&
                obj.occurrenceId !== event["extendedProps"].occurrenceId
        );
        sessionStorage.setItem(
            "scheduledEvents",
            JSON.stringify(scheduledEvents)
        );
        currentEvent.setProp("color", "#8EBF76");
        $("#calendarModal").modal("hide");
        var quantity = document.getElementById("quantity").value - 2;
        document.getElementById("quantity").value = quantity;
        document.getElementById("messageSuccess").innerHTML =
            "Event " +
            event.title +
            " was successfully removed from the schedule!";
    });

    $(document).on("click", "#submitBookingForm", function (event) {
        if ($("#terms").is(":checked")) {
            event.preventDefault();
            var scheduleEvents = getScheduledEvents();
            console.log(document.getElementById("new_package_id").value);
            document.getElementById("new_package_id").value =
                JSON.stringify(usedPackages);

            // Create a promise for the asynchronous operation
            var scheduleEventPromise = new Promise(function (resolve, reject) {
                EventRequestHandler.scheduleEvent(
                    scheduleEvents,
                    function (response) {
                        console.log("Events Sent successfully:", response);
                        resolve(response); // Resolve the promise when the operation is successful
                    },
                    function (error) {
                        console.error("Error scheduling event:", error);
                        reject(error); // Reject the promise when there is an error
                    }
                );
            });

            // Wait for the promise to be resolved and then submit the form
            scheduleEventPromise
                .then(function (response) {
                    console.log(
                        "All asynchronous operations completed successfully."
                    );
                    // Now you can submit the form
                    $("#booking-form").submit();
                })
                .catch(function (error) {
                    console.error(
                        "An error occurred in the asynchronous operations:",
                        error
                    );
                    // Handle error if needed
                });
        }
    });
});

// Listen for the beforeunload event
window.addEventListener('beforeunload', function (event) {

    // Check if it's a page refresh
    if (event.currentTarget.performance.navigation.type === 1) {
        // Clear sessionStorage
        sessionStorage.clear();
    }
});
