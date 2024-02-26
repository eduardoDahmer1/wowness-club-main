@section('title', 'Services')
<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">@lang('Edit Service')</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">
          <div class="card card-form">
              <div class="row no-gutters">
                  <div class="col-12 card-form__body card-body">
                      <form method="POST" action="{{ route('service.updateindividual', $service->id) }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="row justify-content-center">
                              <div class="col-lg-12">
                                  <div class="title-forms-defaults">
                                      <h3>Individual</h3>
                                  </div>
                              </div>    
                            
                              <div class="col-12 d-flex flex-wrap mt-3 type-date">
                                <div class="check-options d-flex align-items-center col-12 px-0 mt-3">
                                  <input id="allday" @checked(isset($occurrence) && $occurrence == "1") class="mr-2" type="radio" value="1" name="occurrence_type">
                                  <label for="allday" class="check-styles px-1">Todos os dias no mesmo horario?</label>
                                </div>
                           
                              <div class="col-12 d-flex flex-wrap mt-3">
                                <div class="startTime">
                                    <label class="p-0 d-flex flex-wrap label-start-end" for="start">Start*</label>
                                    <input type="time" id="start" name="start" value="{{isset($individualAllday->start) ? $individualAllday->start : ''}}"/>
                                </div>
                                <div class="endTime mx-2">
                                    <label class="p-0 d-flex flex-wrap label-start-end" for="end">End*</label>
                                    <div class="d-flex align-items-center">
                                        <input type="time" id="end" name="end" value="{{isset($individualAllday->end) ? $individualAllday->end : ''}}"/>
                                    </div>
                                </div>
                              </div> 
                              <div class="check-options d-flex align-items-center col-12 px-0 mt-5">
                                <input id="custom" class="mr-2" type="radio" @checked(isset($occurrence) && $occurrence == "2") value="2" name="occurrence_type">
                                <label for="custom" class="check-styles px-1">Horários customizados</label>
                              </div>
                                <div class="repeat form-group col-lg-12">
                                    <x-input-label class="col-12 mt-5" :value="__('Repeat every week on...')" style="font-size: 0.9rem;" />
                                    
                                    <div class="checkbox-repeat d-flex flex-wrap mt-3">
                                        <div class="day-container">
                                            <input class="ml-4 weekday" type="checkbox" id="sunday" name="weekday[]" value="0" @checked(isset($individuals[0]) && $individuals[0]->weekday == "0")>
                                            <label style="font-weight: 500;" for="sunday">Sunday</label>
                                            <div class="col-12 d-flex flex-wrap mt-3">
                                                <div class="startTime">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="start_time_sunday">Start*</label>
                                                    <input style="width:70px;" class="smaller" type="time" id="start_time_sunday" name="start_time[0]" value="{{isset($individuals[0]) ? $individuals[0]->start ? $individuals[0]->start : '' : ''}}" />
                                                </div>
                                                <div class="endTime mx-2">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="end_time_sunday">End*</label>
                                                    <div class="d-flex align-items-center">
                                                        <input style="width:70px;" class="smaller" type="time" id="end_time_sunday" name="end_time[0]" value="{{isset($individuals[0]) ? $individuals[0]->end ? $individuals[0]->end : '' : ''}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        {{-- @dd(in_array("0", $individual->weekday)) --}}   
                                        <div class="day-container">
                                             <input class="weekday" type="checkbox" id="monday" name="weekday[]" value="1" @checked(isset($individuals[1]) && $individuals[1]->weekday == "1")>
                                            <label style="font-weight: 500;" for="monday">Monday</label>
                                            <div class="col-12 d-flex flex-wrap mt-3">
                                                <div class="startTime">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="start_time_monday">Start*</label>
                                                    <input class="smaller" style="width:70px;" type="time" id="start_time_monday" value="{{isset($individuals[1]) ? $individuals[1]->start ? $individuals[1]->start : '' : ''}}" name="start_time[1]"/>
                                                </div>
                                                <div class="endTime mx-2">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="end_time_monday">End*</label>
                                                    <div class="d-flex align-items-center">
                                                        <input style="width:70px;" class="smaller" type="time" id="end_time_monday" name="end_time[1]" value="{{isset($individuals[1]) ? $individuals[1]->end ? $individuals[1]->end : '' : ''}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                                    
                                        <div class="day-container">
                                            <input class="weekday" type="checkbox" id="tuesday" name="weekday[]" value="1" @checked(isset($individuals[2]) && $individuals[2]->weekday == "2")>
                                            <label style="font-weight: 500;" for="tuesday">Tuesday</label>
                                            <div class="col-12 d-flex flex-wrap mt-3">
                                                <div class="startTime">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="start_time_tuesday">Start*</label>
                                                    <input style="width:70px;" class="smaller" type="time" id="start_time_tuesday" name="start_time[2]" value="{{isset($individuals[2]) ? $individuals[2]->start ? $individuals[2]->start : '' : ''}}" />
                                                </div>
                                                <div class="endTime mx-2">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="end_time_tuesday">End*</label>
                                                    <div class="d-flex align-items-center">
                                                        <input style="width:70px;" class="smaller" type="time" id="end_time_tuesday" name="end_time[2]" value="{{isset($individuals[2]) ? $individuals[2]->end ? $individuals[2]->end : '' : ''}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="day-container">
                                            <input class="ml-4 weekday" type="checkbox" id="wednesday" name="weekday[]" value="3" @checked(isset($individuals[3]) && $individuals[3]->weekday == "3")>
                                            <label style="font-weight: 500;" for="wednesday">Wednesday</label>
                                            <div class="col-12 d-flex flex-wrap mt-3">
                                                <div class="startTime">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="start_time_wednesday">Start*</label>
                                                    <input style="width:70px;" class="smaller" type="time" id="start_time_wednesday" name="start_time[3]" value="{{isset($individuals[3]) ? $individuals[3]->start ? $individuals[3]->start : '' : ''}}" />
                                                </div>
                                                <div class="endTime mx-2">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="end_time_wednesday">End*</label>
                                                    <div class="d-flex align-items-center">
                                                        <input style="width:70px;" class="smaller" type="time" id="end_time_wednesday" name="end_time[3]" value="{{isset($individuals[3]) ? $individuals[3]->end ? $individuals[3]->end : '' : ''}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                                 
                                        
                                        <div class="day-container">
                                            <input class="ml-4 weekday" type="checkbox" id="thursday" name="weekday[]" value="4" @checked(isset($individuals[4]) && $individuals[4]->weekday == "4")>
                                        <label style="font-weight: 500;" for="thursday">Thursday</label>
                                            <div class="col-12 d-flex flex-wrap mt-3">
                                                <div class="startTime">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="start_time_thursday">Start*</label>
                                                    <input style="width:70px;" class="smaller" type="time" id="start_time_thursday" name="start_time[4]" value="{{isset($individuals[4]) ? $individuals[4]->start ? $individuals[4]->start : '' : ''}}"/>
                                                </div>
                                                <div class="endTime mx-2">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="end_time_thursday">End*</label>
                                                    <div class="d-flex align-items-center">
                                                        <input style="width:70px;" class="smaller" type="time" id="end_time_thursday" name="end_time[4]" value="{{isset($individuals[4]) ? $individuals[4]->end ? $individuals[4]->end : '' : ''}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>      
                                        
                                        <div class="day-container">
                                            <input class="ml-4 weekday" type="checkbox" id="friday" name="weekday[]" value="5" @checked(isset($individuals[5]) && $individuals[5]->weekday == "5")>
                                            <label style="font-weight: 500;" for="friday">Friday</label>
                                            <div class="col-12 d-flex flex-wrap mt-3">
                                                <div class="startTime">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="start_time_friday">Start*</label>
                                                    <input style="width:70px;" class="smaller" type="time" id="start_time_friday" name="start_time[5]" value="{{isset($individuals[5]) ? $individuals[5]->start ? $individuals[5]->start : '' : ''}}" />
                                                </div>
                                                <div class="endTime mx-2">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="end_time_friday">End*</label>
                                                    <div class="d-flex align-items-center">
                                                        <input style="width:70px;" class="smaller" type="time" id="end_time_friday" name="end_time[5]" value="{{isset($individuals[5]) ? $individuals[5]->end ? $individuals[5]->end : '' : ''}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>      
                                        <div class="day-container">
                                            <input class="ml-4 weekday" type="checkbox" id="saturday" name="weekday[]" value="6" @checked(isset($individuals[6]) && $individuals[6]->weekday == "6")>
                                            <label style="font-weight: 500;" for="saturday">Saturday</label>
                                            <div class="col-12 d-flex flex-wrap mt-3">
                                                <div class="startTime">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="start_time_saturday">Start*</label>
                                                    <input style="width:70px;" class="smaller" type="time" id="start_time_saturday" name="start_time[6]" value="{{isset($individuals[6]) ? $individuals[6]->start ? $individuals[6]->start : '' : ''}}" />
                                                </div>
                                                <div class="endTime mx-2">
                                                    <label class="p-0 d-flex flex-wrap label-start-end" for="end_time_saturday">End*</label>
                                                    <div class="d-flex align-items-center">
                                                        <input style="width:70px;" class="smaller" type="time" id="end_time_saturday" name="end_time[6]" value="{{isset($individuals[6]) ? $individuals[6]->end ? $individuals[6]->end : '' : ''}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>

                                  <x-input-label class="col-12 px-0 mt-5" :value="__('Want to add time before or after your events')" />
                                  <div class="d-flex align-items-center col-12 px-0 mt-3">
        
                                      <input @checked(isset($scheduling->when) && $scheduling->when == "Before" || !isset($scheduling->occurrence_type)) id="before" name="before" value="Before" class="check-goals" type="checkbox">
                                      <label for="before" class="check-styles px-1">Before event</label>
                                  </div>
        
                                    <div class="col-12 d-flex flex-wrap px-0">
                                        <div style="width: 80px;">
                                            <x-text-input id="when_time_before" name="when_time_before" required type="number" class="form-control" min="0"
                                            value="{{ isset($scheduling->when) ? $scheduling->schedule_time : '' }}"/>
                                        </div>
                                        <div style="width: 100px;" class="input-group-append mx-2">
                                            <select id="selectBefore" name="selectBefore" class="form-control" data-toggle="select">
                                                <option value="1" {{ old('schedule_type', isset($scheduling->schedule_type) && $scheduling->schedule_type == "1" ? 'selected' : '' ) }}>
                                                    {{ __('Days') }}
                                                </option>
                                                <option value="2" {{ old('schedule_type', isset($scheduling->schedule_type) && $scheduling->schedule_type == "2" ? 'selected' : '' ) }}>
                                                    {{ __('Hours') }}
                                                </option>
                                                <option value="3" {{ old('schedule_type', isset($scheduling->schedule_type) && $scheduling->schedule_type == "3" ? 'selected' : '' ) }}>
                                                    {{ __('Minutes') }}
                                                </option>    
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="d-flex align-items-center col-12 px-0 mt-4">
                                        <input @checked(isset($scheduling->when) && $scheduling->when == "After") id="after" value="After" name="after" class="check-goals" type="checkbox">
                                        <label for="after" class="check-styles px-1">After event</label>
                                    </div>
                                    <div class="col-12 d-flex flex-wrap px-0">
                                        <div style="width: 80px;">
                                            <x-text-input id="when_time_after" name="when_time_after" required type="number" class="form-control" min="0"
                                            value="{{ isset($scheduling->when) ? $scheduling->schedule_time : '' }}"
                                            />
                                        </div>
                                                  
                                        <div style="width: 100px;" class="input-group-append mx-2">         
                                            <select id="selectAfter" name="selectAfter" class="form-control" data-toggle="select">
                                                <option value="1" {{ old('schedule_type', isset($scheduling->schedule_type) && $scheduling->schedule_type == "1" ? 'selected' : '' ) }}>
                                                    {{ __('Days') }}
                                                </option>
                                                <option value="2" {{ old('schedule_type', isset($scheduling->schedule_type) && $scheduling->schedule_type == "2" ? 'selected' : '' ) }}>
                                                    {{ __('Hours') }}
                                                </option>
                                                <option value="3"  {{ old('schedule_type', isset($scheduling->schedule_type) && $scheduling->schedule_type == "3" ? 'selected' : '' ) }}>
                                                    {{ __('Minutes') }}
                                                </option>                                             
                                            </select>
                                        </div> 
                                    </div>
                              </div>
                              
                              <a style="color:#333;" href="{{ route('services.index') }}"
                              class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                              {{ __('Cancel') }}</a>
                              <x-success-button>{{ __('Next') }}</x-success-button>
                          </div> <!-- Final da Row -->
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
</x-app-layout>

<script src="{{ asset('assets/admin/js/flatpickr.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    .check-options input {
        -webkit-appearance: none;
        background: white;
        border: 1.85px solid #EBEBEB;
        border-radius: 50%;
        width: 17px;
        height: 17px;
    }
    
    .check-options input:checked {
    background-color: #2AACE4;
    }

    .repeat input[type="checkbox"] {
        margin-right: 10px;
        margin-left: 20px;
        margin-top: auto;
        transform: scale(1.4);
    }
    .checkbox-repeat label{
        font-size: 1rem !important;
        margin-top: auto;
    }
    .time-inputs input[type="time"] {
        width: 10%; 
    }
</style>

<script>
    $(document).ready(function() {
        var occurrence = "<?php echo isset($occurrence) ? $occurrence : 'null'; ?>";
        if(occurrence == 1){
            $('#start').prop("disabled", false)
            $('#end').prop("disabled", false)
            $(".weekday").prop('disabled', true)
            $(".smaller").prop('disabled', true)
        }else if(occurrence == 2){
            $('#start').prop("disabled", true)
            $('#end').prop("disabled", true)
            $(".weekday").prop('disabled', false)
            $(".smaller").prop('disabled', false)
        }

        var days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
        for (var i = 0; i < days.length; i++) {
            $("#" + days[i]).change(function() {
                var day = this.id;
                if(this.checked){
                    $("#start_time_" + day).prop("disabled", false);
                    $("#end_time_" + day).prop("disabled", false);
                } else {
                    $("#start_time_" + day).prop("disabled", true);
                    $("#end_time_" + day).prop("disabled", true);
                }
            });
        }

        $('#allday, #custom').on('change', function(){
           var checkedAllday = $('#allday')[0].checked;
           var checkedCustom = $('#custom')[0].checked;
           if(checkedAllday){
                $('#start').prop("disabled", false)
                $('#end').prop("disabled", false)
                $(".weekday").prop('disabled', true)
                $(".smaller").prop('disabled', true)
            }else{
                $('#start').prop("disabled", true)
                $('#end').prop("disabled", true)
                $(".weekday").prop('disabled', false)
                $(".smaller").prop('disabled', false)
            }
        });
    });
    const inputAfter = document.querySelector('#after')
    const inputBefore = document.querySelector('#before')
    const selectAfter = document.querySelector('#selectAfter')
    const selectBefore = document.querySelector('#selectBefore')
    const timeBefore = document.querySelector('#when_time_before')
    const timeAfter = document.querySelector('#when_time_after')

    document.addEventListener('DOMContentLoaded', function() {
        if(inputAfter.checked) {
            selectBefore.disabled = true
            selectAfter.disabled = false
            timeBefore.disabled = true
            timeBefore.value = ''
            timeAfter.disabled = false
            inputBefore.checked = false
        } else {
            selectAfter.disabled = true
            selectBefore.disabled = false
            timeAfter.disabled = true
            timeAfter.value = ''
            timeBefore.disabled = false
            inputAfter.checked = false
        }
    })
    inputAfter.addEventListener('change', () => {
        selectBefore.disabled = true
        selectAfter.disabled = false
        timeBefore.disabled = true
        timeBefore.value = ''
        timeAfter.disabled = false
        inputBefore.checked = false
    })

    inputBefore.addEventListener('change', () => {
        selectAfter.disabled = true
        selectBefore.disabled = false
        timeAfter.disabled = true
        timeAfter.value = ''
        timeBefore.disabled = false
        inputAfter.checked = false
    })
</script>