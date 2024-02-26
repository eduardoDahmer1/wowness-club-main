<!-- <!DOCTYPE html>
<head>
    <meta charset='utf-8'/>
    <title>
        Full Calendar - CRUD Matteo Carminato
    </title> -->

    {{-- Boostrap v5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
                                @if(session('message'))
                                    <div class="col-8 mt-3 mb-0" id="poPup">
                                        <div class="d-flex justify-content-end">
                                            <button class="bt-close"><i  style="color:#ff09098a;" class="material-symbols-outlined">cancel</i></button>
                                        </div>
                                        <div class="msg-bg d-flex align-items-center">           
                                            <span class="msg">{{ session('message') }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid page__container">
                        <div class="d-flex justify-content-end">
                            <div class="mr-2">
                                <a href="{{ route('services.edit', $service) }}" class="btn btn-primary p-1 text-uppercase fw-bold"><i class="material-icons">create</i>Edit Service</a>
                            </div>
                            <div>
                                <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="btn btn-primary p-1 text-uppercase fw-bold"><i class="mr-1 fas fa-external-link-alt"></i>View Service</a>
                            </div>
                        </div>
                        <div class="card">
                        @if($service->recurring == 2 || $service->recurring == 3 && $service->type->value != 2)
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary p-2 text-uppercase fw-bold" id="test" onclick="openModal()">Edit Dates</button>
                            </div>
                        @endif
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    @if($service->type->value != 2)
    {{--Modal Update Recurrence--}}
    <div class="modal fade p-5" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog mt-5">
            <div class="modal-content border-0 col-12">
                <div class="modal-header d-flex align-items-center pt-4">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Service Date</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form class="px-3" method="POST" action="{{route('calendar.updateevents')}}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <div class="modal-body p-0 pt-3">
                        <div class="mb-0">
                            <input type="hidden" class="form-control" id="create-title" name="title"
                            aria-describedby="emailHelp" value="{{$service->name}}" required>
                        </div>
                        <div>
                            <input type="hidden" class="form-control" id="create_resource" name="resourceId"
                            value="a">
                        </div>
                        <div class="hiddenDate">
                            <div class="mb-3">
                                <label for="exampleColorInput" class="form-label">Color picker</label>
                                <input type="color" name="color" class="form-control form-control-color"
                                id="update-color"
                                title="Choose your color" required>
                            </div>
                            <div class="mb-3">
                                <label for="datetime-local">Start</label>
                                <input type="datetime-local" class="form-control" id="update-start" name="start" required>
                            </div>
                            <div class="mb-3">
                                <label for="datetime-local">End</label>
                                <input type="datetime-local" class="form-control" id="update-end" name="end" required>
                            </div>
                            <div class="endRepeat mb-3 mx-1" id="div-endrepeat">
                            <input type="checkbox" id="end_repeat" name="end_repeat" value="1" @checked($service->end_repeat)>
                        <label for="end_repeat" class="endrepeat ml-2">End repeat?</label>
                    </div>
                </div>
                        <div>
                            <input type="hidden" name="service_id" value="{{$service->id}}">
                        </div>
                    </div>
                    <div class="col-12 px-0">
                        <div class="title-forms-defaults">
                            <h6>Recurrences</h6>
                        </div>
                    </div>

                    <div class="form-group">
                        <x-input-label class="col-12 mb-1 px-0" for="recurring" :value="__('Recurring*')" />
                        <div class="form-group col-12 px-0">
                            <select onchange="optionValue(this)" id="recurring" name="recurring" data-toggle="select">
                                <option value="" selected disabled>{{__('Select the recurrence')}}</option>
                                @foreach ($recurrings as $recurring)
                                    <option value="{{ $recurring->value }}" {{ $service->recurring == $recurring->value ? 'selected' : '' }}>
                                        {{ $recurring->name() }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('recurring')" />
                        </div>
                    </div>

                    <div class="repeat form-group col-lg-12 px-0 diveveryweek">
                        <x-input-label class="col-12 px-0" :value="__('Repeat every week on...')" style="font-size: 0.9rem;" />
                        <div class="checkbox-repeat d-flex flex-wrap mt-3 justify-content-between">
                            <div>
                                <input type="checkbox" id="monday" name="weekday[]" value="1" {{isset($service) ? ($service->weekday ? (in_array("1", $service->weekday) ? 'checked' : '') : '') : '' }}>
                                <label class="mb-0" style="font-weight: 500; color:#495057;" for="monday">Monday</label>
                            </div>
                            <div>
                                <input type="checkbox" id="tuesday" name="weekday[]" value="2"  {{isset($service) ? ($service->weekday ? (in_array("2", $service->weekday) ? 'checked' : '') : '') : '' }}>
                                <label class="mb-0" style="font-weight: 500; color:#495057;" for="tuesday">Tuesday</label>
                            </div>
                            <div>
                                <input type="checkbox" id="wednesday" name="weekday[]" value="3" {{isset($service) ? ($service->weekday ? (in_array("3", $service->weekday) ? 'checked' : '') : '') : '' }}>
                                <label class="mb-0" style="font-weight: 500; color:#495057;" for="wednesday">Wednesday</label>
                            </div>
                            <div>
                                <input type="checkbox" id="thursday" name="weekday[]" value="4"  {{isset($service) ? ($service->weekday ? (in_array("4", $service->weekday) ? 'checked' : '') : '') : '' }}>
                                <label class="mb-0" style="font-weight: 500; color:#495057;" for="thursday">Thursday</label>
                            </div>
                        </div>
                        <div class="checkbox-repeat d-flex flex-wrap mt-3 justify-content-center">
                            <div>
                                <input type="checkbox" id="friday" name="weekday[]" value="5"  {{isset($service) ? ($service->weekday ? (in_array("5", $service->weekday) ? 'checked' : '') : '') : '' }}>
                                <label style="font-weight: 500; color:#495057;" for="friday">Friday</label>
                            </div>
                            <div class="px-4">
                                <input type="checkbox" id="saturday" name="weekday[]" value="6"  {{isset($service) ? ($service->weekday ? (in_array("6", $service->weekday) ? 'checked' : '') : '') : '' }}>
                                <label style="font-weight: 500; color:#495057;" for="saturday">Saturday</label>
                            </div>
                            <div>
                                <input type="checkbox" id="sunday" name="weekday[]" value="0"  {{isset($service) ? ($service->weekday ? (in_array("0", $service->weekday) ? 'checked' : '') : '') : '' }}>
                                <label style="font-weight: 500; color:#495057;" for="sunday">Sunday</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 dateRecurrenceDiv mt-2 px-0">
                        <div class="form-group recurrences">
                            <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold" data-handler="newinputRecurrence" data-ratio="recurrence">+ add dates *</button>
                            <x-input-info-label>Create especific dates for service recurrence</x-input-info-label>
                            @foreach($service->recurrences as $recurrence)
                            <div id="recurrence_{{ $recurrence->id }}" class="recurrenceDiv container-fluid mb-3 mt-3">
                                <div class="row align-items-end">
                                    <div class="col-lg-6 pl-0">
                                        <x-input-label for="start_date[{{$loop->index}}]" :value="__('Start *')" />
                                        <div class="flatpickr">
                                            <input type="datetime-local" name="start_date[{{$loop->index}}]" required id="start_date[{{$loop->index}}]"
                                                class="form-control" placeholder="Choose start date"
                                                data-toggle="flatpickr" data-flatpickr-min-date="today"
                                                data-flatpickr-enable-time="true"
                                                data-flatpickr-alt-format="F j, Y at H:i"
                                                data-flatpickr-date-format="Y-m-d H:i" value="{{ $recurrence->start_date ? \Carbon\Carbon::parse($recurrence->start_date)->format('Y-m-d\TH:i:s') : ''  }}">
                                                <i style="font-size: 14px;" class="fa fa-calendar-alt"></i>
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                                    </div>

                                    <div class="col-lg-6 pl-0 ">
                                        <x-input-label for="end" :value="__('End *')" />
                                        <div class="d-flex align-items-center">
                                            <div class="flatpickr w-100">
                                                <input type="datetime-local" name="end_date[{{$loop->index}}]" required id="end_date"
                                                class="form-control" placeholder="Choose closing date"
                                                data-toggle="flatpickr" data-flatpickr-enable-time="true"
                                                data-flatpickr-alt-format="F j, Y at H:i"
                                                data-flatpickr-date-format="Y-m-d H:i"
                                                value="{{  $recurrence->end_date ? \Carbon\Carbon::parse($recurrence->end_date)->format('Y-m-d\TH:i:s') : '' }}">
                                                <i style="font-size: 14px;" class="fa fa-calendar-alt"></i>
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('end')" />
                                            <i style="font-size: 20px;position: absolute;right: -8px;" class="material-icons icon-delete delete-recurring p-0 m-0 mt-2" onclick="removeParent(this)" data-ratio="recurrence">delete</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="recurrencesId" name="recurrencesId" value="">
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    {{--Modal Update Date--}}
    <div class="modal fade p-5" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog mt-5">
            <div class="modal-content border-0 col-12">
                <div class="modal-header d-flex align-items-center pt-4">
                    <h5 class="modal-title" id="staticBackdropLabel">Change the times for that specific day</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form method="POST" action="{{ route('update.timesofday', $service->id) }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <div class="modal-body">
                        <div class="mb-0">
                            <input type="hidden" class="form-control" id="create-title" name="title" aria-describedby="emailHelp" value="{{ $service->name }}" required>
                        </div>
                        <div>
                            <input type="hidden" class="form-control" id="create_resource" name="resourceId" value="a">
                        </div>
                        <input type="hidden" class="form-control" id="create-start" name="start" required>
                        <div>
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                        </div>
                        <div class="m-0 pt-0 d-flex justify-content-between">
                            <div class="title-forms-defaults m-0 pt-0 border-0">
                                <h6 id="this-date-card">Date: 00/00/0000</h6>
                            </div>
                            <div>
                                <i class="icon-plus" style="font-size:30px;font-style: normal;line-height: 0;font-weight: 300;">+</i>
                            </div>
                        </div>
                        <div id="div-date" class="d-flex flex-wrap justify-content-between">
                            @foreach ($recurrences as $key => $recurrence)
                            <div data-start-date="{{$recurrence->start_date}}" class="d-flex times mb-3">
                                    <div class="startTime">
                                        <label class="p-0 d-flex flex-wrap label-start-end" for="start_time">Start*</label>
                                        <input type="time" id="start_time" value="{{ \Carbon\Carbon::parse($recurrence->start_date)->format('H:i') }}" name="start_time[{{$key}}][]" />
                                    </div>
                                    <div class="endTime mx-2">
                                        <label class="p-0 d-flex flex-wrap label-start-end" for="end_time">End*</label>
                                        <div class="d-flex align-items-center">
                                            <input type="time" id="end_time" value="{{ \Carbon\Carbon::parse($recurrence->end_date)->format('H:i') }}" name="end_time[{{$key}}][]"/>
                                            <div><i class="material-icons icon-delete icon-del" onclick="removeParent(this)">delete</i></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer mt-4 d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

<style>
    .fc .fc-button-primary{
        background-color: #7B9A6C !important;
        border-color: white !important;
    }
    .icon-del {
        font-size: 20px !important;
        padding: 0;
        margin: 0;
    }
    input[type="time"] {
        border: 1px solid #f1f1f1;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 300;
    }
    .label-start-end {
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        color: #7f7f7f;
        margin: 0 !important;
    }

    .flatpickr input {
        font-size: 12px !important;
    }
</style>

<script src="{{ asset('assets/admin/js/flatpickr.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- Boostrap v5 --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>

{{-- Full Calendar v5 --}}
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.js'></script>

<!-- rrule lib -->
<script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>

<!-- the rrule-to-fullcalendar connector. must go AFTER the rrule lib -->
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@5.11.5/main.global.min.js'></script>

{{-- Moment JS--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
    .endRepeat input[type="checkbox"]{
        transform: scale(1.30);
    }
    .endrepeat{
        color: #495057;
        font-weight: 500;
        font-size: 1rem;
    }
    .bt-close {
        border: none;
        background: none;
        z-index: 10000;
    }
    
    .msg-bg {
        font-size: 22px;
        text-align: center;
        font-weight: 350;
        padding: 10px;
        padding-right: 0px;
        border-radius: 6px;
        z-index: 1000;
        box-shadow: 0 0 7px 1px #8ebf76ac;
    }
    .msg {
        margin: 0;
        color: #7B9A6C;
    }
    @media (max-width: 550) {
        .msg-bg {
            font-size: 18px;
            margin: 10px;
            left: 0px;
        }
        .bt-close {
        left: 15px;
        top: 35px;
        }
    }
</style>
<script>
    const btNfechar = document.querySelector('.bt-close')
    btNfechar.addEventListener('click', function (event) {
        const poPup = document.querySelector('#poPup')
        poPup.style.display = 'none';
    })
    
    var recurring = @json($service->recurring);
    $(document).ready(function(){
        if (recurring == 6) {
            $('.dateRecurrenceDiv').show();
            $('.hiddenDate').hide();
        } else {
            $('.dateRecurrenceDiv').hide();
            $('.hiddenDate').show();
        }
        $('#recurring').change(function() {;
            var selectedOption = $('#recurring').val();
            if(selectedOption == 3 || selectedOption == 2){
                $('.endRepeat').show();
            }else{
                $('.endRepeat').hide();
            }
            if (selectedOption == 6) {
                $('.dateRecurrenceDiv').show();
                $('.hiddenDate').hide();
            } else {
                $('.dateRecurrenceDiv').hide();
                $('.hiddenDate').show();
            }
        });
    });
</script>
@include('admin.calendar.scripts')
