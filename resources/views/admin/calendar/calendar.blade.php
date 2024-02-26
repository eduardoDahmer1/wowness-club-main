<!-- <!DOCTYPE html>
<head>
    <meta charset='utf-8'/>
    <title>
        Full Calendar - CRUD Matteo Carminato
    </title> -->

    {{-- Boostrap v5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Full Calendar v5 --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.css' rel='stylesheet'/>


<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Calendar</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Calendar')</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid page__container">
            <div class="card">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</x-app-layout>

{{--Modal Create--}}
<div class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Especific Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{route('calendar.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="create-title" name="title"
                               aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="create-description" name="description"
                               aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Color picker</label>
                        <input type="color" name="color" class="form-control form-control-color"
                               id="create-color" value="#563d7c"
                               title="Choose your color" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" id="create_status" name="status"
                                required>
                            <option value="1">Pending</option>
                            <option value="2">Confirmed</option>
                            <option value="3">Canceled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Resource</label>
                        <select class="form-select" aria-label="Default select example" id="create_resource"
                                name="resourceId" required>
                            <option value="a">A</option>
                            <option value="b">B</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">Start</label>
                        <input type="datetime-local" class="form-control" id="create-start" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">End</label>
                        <input type="datetime-local" class="form-control" id="create-end" name="end" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--Modal Update--}}
<div class="modal fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('calendar.updateevents')}}">
                @method('PUT')
                @csrf
                <input type="hidden" id="id" name="id" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="update-title" name="title"
                               aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Color picker</label>
                        <input type="color" name="color" class="form-control form-control-color"
                               id="update-color"
                               title="Choose your color" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="create_resource" name="resourceId"
                        value="a">
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">Start</label>
                        <input type="datetime-local" class="form-control" id="update-start" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">End</label>
                        <input type="datetime-local" class="form-control" id="update-end" name="end" required>
                    </div>

                    {{-- Para atualizar o servico no calendario geral é preciso enviar o id do servico
                        <div>
                        <input type="hidden" name="service_id" value="{{$service->id}}">
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var SITEURL = "{{ url('/') }}";
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            nowIndicator: true,
            editable: true,
            selectable: true,
            navLinks: true,
            timeZone: 'America/Sao_Paulo',
            locale: 'en',
            initialView: 'dayGridMonth',
            eventColor: 'gray',
            resources: [
                {id: 'a', title: 'Room A'},
            ],
            eventTimeFormat: { 
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short'
            },
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'resourceTimeGridDay,resourceTimeGridWeek,dayGridMonth'
            },
            events: "{{ route('calendar.getevents') }}",
            dateClick: function (info) {
                var start = moment(info.dateStr).format('YYYY-MM-DD\THH:mm');
                var end = moment(info.dateStr).add(30, 'minutes').format('YYYY-MM-DD\THH:mm');

                document.getElementById('create-start').value = start;
                document.getElementById('create-end').value = end;

                var myModal = new bootstrap.Modal(document.getElementById('modal-create'))
                myModal.show()
            },
            eventClick: function (info) {
                let id_event = info.event._def['publicId'];
                let _token = document.getElementsByName("_token")[0].value;
                document.getElementById('id').value = id_event;

                $.ajax({
                    method: "get",
                    url: SITEURL + '/calendar/' + id_event + '/edit',
                    data: {
                        _token: _token
                    },
                    success: function (response) {
                        document.getElementById('update-title').value = response.data.title;
                        document.getElementById('update-start').value = response.data.start;
                        document.getElementById('update-end').value = response.data.end;
                        document.getElementById('update-color').value = response.data.color;

                        var myModal = new bootstrap.Modal(document.getElementById('modal-update'))
                        myModal.show()
                    }
                });
            },
            eventDrop: function (info) {
                if (!confirm("You are requesting a change: " + info.event.title +
                    "\nThe service will be changed to the date: " + moment(info.event.startStr).format(
                        'DD-MM-YYYY HH:mm:ss')))
                {
                    info.revert();
                } else {
                    let id_event = info.event._def['publicId'];
                    let _token = document.getElementsByName("_token")[0].value;
                    let start = moment(info.event.startStr).format('YYYY-MM-DD\THH:mm');
                    let end = moment(info.event.endStr).format('YYYY-MM-DD\THH:mm');

                    $.ajax({
                        url: "{{route('calendar.dropevents')}}",
                        method: "post",
                        data: {
                            id: id_event,
                            resourceId: "a",
                            start: start,
                            end: end,
                            _token: _token
                        },
                    });
                }
            },
            eventResize: function (info) {
                let id_event = info.event._def['publicId'];
                let _token = document.getElementsByName("_token")[0].value;
                let end = moment(info.event.endStr).format('YYYY-MM-DD\THH:mm');

                $.ajax({
                    url: "{{route('calendar.resizeevents')}}",
                    method: "post",
                    data: {
                        id: id_event,
                        end: end,
                        _token: _token
                    },
                    success: function (result) {
                        alert("atualização ok");
                    }
                });
            },
        });
        calendar.render();
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    .fc .fc-button-primary{
        background-color: #7B9A6C !important;
        border-color: white !important;
    }
</style>

{{-- Boostrap v5 --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

{{-- Full Calendar v5 --}}
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.js'></script>

{{-- Moment JS--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
