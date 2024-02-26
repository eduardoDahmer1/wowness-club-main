<script>
    
    
    var recurring = @json($service->recurring);
    if(recurring == 2 || recurring == 3){
        function openModal(){
            var serviceId = '{{$service->id}}'
            $.ajax({
                method: "GET",
                url: '/services/'+ serviceId +'/created',
                data: serviceId,
                success: function(res){
                    $.ajax({
                        method: "GET",
                        url: SITEURL + '/calendar/' + res + '/edit',
                        success: function (response) {
                            document.getElementById('update-start').value = response.data.start;
                            document.getElementById('update-end').value = response.data.end;
                            document.getElementById('update-color').value = response.data.color;
            
                            var myModal = new bootstrap.Modal(document.getElementById('modal-update'))
                            myModal.show()
                        }
                    });
                }
            });
        }
    }

    $(document).ready(function () {
        if (recurring == 6) {
            $('.dateRecurrenceDiv').show();
            $('.hiddenDate').parent().addClass('d-none');
            $('.hiddenDate').hide();
        } else {
            $('.dateRecurrenceDiv').hide();
            $('.hiddenDate').parent().removeClass('d-none');
            $('.hiddenDate').show();
        }

        if (recurring == 3) {
            $('.diveveryweek').show()
        } else {
            $('.diveveryweek').hide()
        }

        if(recurring == 3 || recurring == 2){
            $('#div-endrepeat').show()
        }else{
            $('#div-endrepeat').hide()
        }
    });

    function optionValue(optionSelected) {
        if (optionSelected.value == '6') {
            $('.dateRecurrenceDiv').show();
            $('.hiddenDate').parent().addClass('d-none');
            $('.hiddenDate').hide();
        } else {
            $('.dateRecurrenceDiv').hide();
            $('.hiddenDate').parent().removeClass('d-none');
            $('.hiddenDate').show();
        }

        if (optionSelected.value == '3') {
            $('.diveveryweek').show()
        } else {
            $('.diveveryweek').hide()
        }
        
        if(optionSelected.value == 3 || optionSelected.value == 2){
            $('#div-endrepeat').show()
        }else{
            $('#div-endrepeat').hide()
        }
    }

    $(document).ready(function() {
        localStorage.setItem('oldServiceStart', "{{$service->start}}");
        localStorage.setItem('oldServiceEnd', "{{$service->end}}");
    });

    var serviceStart = "{{$service->start}}";
    var serviceType = "{{$service->type->value}}";
    var serviceEnd = "{{$service->end}}";
    var serviceName = "{{$service->name}}";
    var serviceId = "{{$service->id}}";
    var recurring = "{{$service->recurring}}";
    var recurrences = "{{$recurrences->count()}}";        
    var recurrence_type = "{{App\Enums\Recurring::from($service->recurring)->name()}}";
  
    if(serviceStart != null && serviceEnd != null && recurring != 6 && serviceType != 2){
        $.ajax({
            url: '/calendar',
            type: 'POST',
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                start: serviceStart,
                end: serviceEnd,
                title: serviceName,
                resourceId: "a",
                color: '#7B9A6C',
                service_id: serviceId,
                recurrence_type: recurrence_type,
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
    var SITEURL = "{{ url('/') }}";
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            nowIndicator: true,
            // plugins: ["interaction", "dayGrid", "timeGrid", "resourceTimeline", "rrule"],
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
            events: "{{ route('calendar.getservices', ['service_id' => $service->id]) }}",
            dateClick: function (info) {
                var start = moment(info.dateStr).format('YYYY-MM-DD\THH:mm');
                var end = moment(info.dateStr).add(30, 'minutes').format('YYYY-MM-DD\THH:mm');

                document.getElementById('create-start').value = start;

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
                        document.getElementById('update-start').value = response.data.start;
                        document.getElementById('update-end').value = response.data.end;
                        document.getElementById('update-color').value = response.data.color;

                        // for (let index = 0; index < recurrences; index++) {
                            //    document.getElementsByName("start_date["+index+"]").
                            // }

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
                    console.log(info)
                    let id_event = info.event._def['publicId'];
                    let _token = document.getElementsByName("_token")[0].value;
                    let start = moment(info.event.startStr).format('YYYY-MM-DD\THH:mm');
                    let end = moment(info.event.endStr).format('YYYY-MM-DD\THH:mm');
                    let resource = info.event._def.resourceIds[0];
                    $.ajax({
                        url: "{{route('calendar.dropevents')}}",
                        method: "post",
                        data: {
                            id: id_event,
                            start: start,
                            resourceId:resource,
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

    if (document.querySelector('[data-handler=newinputRecurrence]')) {

        let NewInputRecurrence = document.querySelector('[data-handler=newinputRecurrence]')
        NewInputRecurrence.addEventListener('click', handlerNewInputsRecurrence)
        function handlerNewInputsRecurrence() {

            let idName = this.getAttribute("data-ratio")
            let arrayBox = document.querySelectorAll('.recurrenceDiv').length
            let divContent = document.createElement("div")

            divContent.classList.add("recurrenceDiv","container-fluid")
            divContent.innerHTML = `
                <div id="recurrence_${arrayBox}" class="row align-items-end mb-3">

                    <div class="col-lg-6 pl-0">
                        <x-input-label for="start_date[${arrayBox}]" :value="__('Start *')" />
                        <div class="flatpickr">
                            <input type="datetime-local" name="start_date[${arrayBox}]" required id="start_date[${arrayBox}]"
                                class="form-control" placeholder="Choose start date"
                                data-toggle="flatpickr" data-flatpickr-min-date="today"
                                data-flatpickr-enable-time="true"
                                data-flatpickr-alt-format="F j, Y at H:i"
                                data-flatpickr-date-format="Y-m-d H:i" value="{{ old('start_date[${arrayBox}]') }}">
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('${idName}.${arrayBox}.start_date')" />
                    </div>

                    <div class="col-lg-6 pl-0 ">
                        <x-input-label for="end_date[${arrayBox}]" :value="__('End *')" />
                        <div class="d-flex align-items-center">
                            <div class="flatpickr w-100">
                                <input type="datetime-local" name="end_date[${arrayBox}]" required id="end_date[${arrayBox}]"
                                class="form-control" placeholder="Choose closing date"
                                data-toggle="flatpickr" data-flatpickr-enable-time="true"
                                data-flatpickr-alt-format="F j, Y at H:i"
                                data-flatpickr-date-format="Y-m-d H:i"
                                value="{{ old('end_date[${arrayBox}]') }}">
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('${idName}.${arrayBox}.end_date')" />
                            <i style="font-size: 20px;position: absolute;right: -8px;" class="material-icons icon-delete delete-recurring p-0 m-0 mt-2" onclick="removeParent(this)" data-ratio="recurrence">delete</i>
                        </div>
                    </div>
                </div>
            `
            this.parentNode.insertBefore(divContent, null)
        }
    }

    function deleteRecurrence(i) {
        i.parentNode.remove();
    }

    const myModalEl = document.getElementById('modal-create')
    if(myModalEl) {
        myModalEl.addEventListener('show.bs.modal', event => {
            dateCardClick = document.getElementById('this-date-card')
            var inputElement = document.getElementById('create-start')
            var dateValue = inputElement.value
            var allDates = document.querySelectorAll('[data-start-date]');
            var dateObject = new Date(dateValue)
            var day = dateObject.getDate()
            var month = dateObject.getMonth() + 1
            var year = dateObject.getFullYear()
            var formattedDate = day + '/' + month + '/' + year

            allDates.forEach(element => {
                startDateAtribute = element.getAttribute('data-start-date')
                startDate = new Date(startDateAtribute)

                // Verifica se o dia da data é diferente
                if (startDate.getDate() !== day) {
                    element.classList.replace('d-flex', 'd-none');

                    // Desabilita todos os inputs dentro do elemento
                    const inputs = element.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.disabled = true;
                    });
                } else {
                    element.classList.replace('d-none', 'd-flex');

                    // Habilita todos os inputs dentro do elemento
                    const inputs = element.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.disabled = false;
                    });
                }
            });

            if(dateCardClick) {
                dateCardClick.innerHTML = 'Date: ' + formattedDate
            }
        })
    }

    function removeParent(button) {
        button.parentNode.parentNode.parentNode.parentNode.remove();
    }

    function newInputTime() {
        const divFather = document.getElementById('div-date');
        var allTimes = divFather.querySelectorAll('.times')
        let arrayKay = allTimes.length;
        let divContent = document.createElement("div")

        divContent.classList.add("d-flex", "times", "mb-3")
        divContent.innerHTML = `
        <div class="startTime">
            <label class="p-0 d-flex flex-wrap label-start-end" for="start_time[${arrayKay}][]">Start*</label>
            <input type="time" id="start_time" name="start_time[${arrayKay}][]" required />
        </div>
        <div class="endTime mx-2">
            <label class="p-0 d-flex flex-wrap label-start-end" for="end_time[${arrayKay}][]">End*</label>
            <div class="d-flex align-items-center">
                <input type="time" id="end_time" name="end_time[${arrayKay}][]" required />
                <div><i class="material-icons icon-delete icon-del" onclick="removeParent(this)">delete</i></div>
            </div>
        </div>
        `
        divFather.insertBefore(divContent, null)
    }

    const iconPlus = document.querySelectorAll('.icon-plus')
    iconPlus.forEach( (element) => element.addEventListener('click', newInputTime))
</script>
