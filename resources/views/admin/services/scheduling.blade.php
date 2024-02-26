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
                      <form method="POST" action="{{ route('scheduling.update', $service->id) }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="row justify-content-center">

                              <div class="col-lg-12">
                                  <div class="title-forms-defaults">
                                      <h3>Schedulling condition</h3>
                                  </div>
                              </div>
                              <div class="col-12 d-flex flex-wrap">
                                  <x-input-label class="col-12 p-0" :value="__('Invites can`t schedule e within...*')" />
                                  <div style="width: 80px;">
                                    <x-text-input id="not_schedule" name="not_schedule" type="number"
                                        class="form-control" min="0" required value="{{ isset($service->scheduling->not_schedule) ? $service->scheduling->not_schedule : '' }}"/> 
                                  </div>
                                  <div style="width: 100px;" class="input-group-append mx-2">
                                      <select name="not_schedule_type" class="form-control" data-toggle="select">
                                            <option value="1" {{ isset($service->scheduling->not_schedule_type) && $service->scheduling->not_schedule_type === 1 ? 'selected' : '' }}>
                                                {{ __('Days') }}
                                            </option>
                                            <option value="2" {{ isset($service->scheduling->not_schedule_type) && $service->scheduling->not_schedule_type === 2 ? 'selected' : '' }}>
                                                {{ __('Hours') }}
                                            </option>
                                            <option value="3" {{ isset($service->scheduling->not_schedule_type) && $service->scheduling->not_schedule_type === 3 ? 'selected' : '' }}>
                                                {{ __('Minutes') }}
                                            </option>
                                      </select>
                                  </div> 
                              </div>

                              <div class="col-12 mt-3">
                                  <x-input-label for="max_events" :value="__('Maximum allowed events per day for this type of event*')" />
                                  <div style="width: 80px;">
                                    <x-text-input id="max_events" name="max_events" type="number"
                                        class="form-control" min="0" required value="{{ isset($service->scheduling->max_events) ? $service->scheduling->max_events : '' }}                                        "/> 
                                  </div>
                              </div>

                              <div class="col-12 d-flex flex-wrap mt-3">
                                  <x-input-label class="col-12 px-0" :value="__('Want to add time before or after your events')" />
                                  <div class="d-flex align-items-center col-12 px-0 mt-3">
                                      <input @checked(isset($service->scheduling->when) && $service->scheduling->when === 1 || !isset($service->scheduling->when)) id="before" name="when" value="1" class="check-goals" type="checkbox">
                                      <label for="before" class="check-styles px-1">Before event</label>
                                  </div>

                                    <div class="col-12 d-flex flex-wrap px-0">
                                        <div style="width: 80px;">
                                            <x-text-input id="when_time_before" name="when_time" required type="number" class="form-control" min="0"
                                            value="{{ isset($service->scheduling->when) && $service->scheduling->when === 1 ? $service->scheduling->when_time : '' }}"/>
                                        </div>
                                        <div style="width: 100px;" class="input-group-append mx-2">
                                            <select id="selectBefore" name="when_type" class="form-control" data-toggle="select">
                                                <option value="1" {{ old('when_type', isset($service->scheduling->when) && $service->scheduling->when == 1 && $service->scheduling->when_type == 1 ? 'selected' : '' ) }}>
                                                    {{ __('Days') }}
                                                </option>
                                                <option value="2" {{ old('when_type', isset($service->scheduling->when) && $service->scheduling->when == 1 && $service->scheduling->when_type == 2 ? 'selected' : '' ) }}>
                                                    {{ __('Hours') }}
                                                </option>
                                                <option value="3" {{ old('when_type', isset($service->scheduling->when) && $service->scheduling->when == 1 && $service->scheduling->when_type == 3 ? 'selected' : '' ) }}>
                                                    {{ __('Minutes') }}
                                                </option>    
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="d-flex align-items-center col-12 px-0 mt-4">
                                        <input @checked(isset($service->scheduling->when) && $service->scheduling->when === 2) id="after" value="2" name="when" class="check-goals" type="checkbox">
                                        <label for="after" class="check-styles px-1">After event</label>
                                    </div>
                                    <div class="col-12 d-flex flex-wrap px-0">
                                        <div style="width: 80px;">
                                            <x-text-input id="when_time_after" name="when_time" required type="number" class="form-control" min="0"
                                            value="{{ isset($service->scheduling->when) && $service->scheduling->when === 2 ? $service->scheduling->when_time : ''}}"
                                            />
                                        </div>
                                        <div style="width: 100px;" class="input-group-append mx-2">
                                            <select id="selectAfter" name="when_type" class="form-control" data-toggle="select">
                                                <option value="1" {{ old('when_type', isset($service->scheduling->when) && $service->scheduling->when == 2 && $service->scheduling->when_type == 1 ? 'selected' : '' ) }}>
                                                    {{ __('Days') }}
                                                </option>
                                                <option value="2" {{ old('when_type', isset($service->scheduling->when) && $service->scheduling->when == 2 && $service->scheduling->when_type == 2 ? 'selected' : '' ) }}>
                                                    {{ __('Hours') }}
                                                </option>
                                                <option value="3" {{ old('when_type', isset($service->scheduling->when) && $service->scheduling->when == 2 && $service->scheduling->when_type == 3 ? 'selected' : '' ) }}>
                                                    {{ __('Minutes') }}
                                                </option>                                             
                                            </select>
                                        </div> 
                                    </div>
                              </div>
                            
                              <div class="col-12 d-flex flex-wrap mt-3 type-date">
                                    <x-input-label class="col-12 px-0" for="duration" :value="__('Clients can schedule..')" />
                                    <div class="col-12 d-flex flex-wrap px-0">
                                        <div class="check-options d-flex align-items-center">
                                            <input @checked(isset($service->scheduling->indefinitely) && $service->scheduling->indefinitely === 1 || !isset($service->scheduling->indefinitely)) id="scheduleType1" class="mt-2 mr-2" type="radio" name="indefinitely" value="1">
                                        </div>
                                        <div style="width: 80px;">
                                            <x-text-input id="schedule_time" required name="schedule_time" type="number"
                                                class="form-control" min="0" value="{{ isset($service->scheduling->schedule_time) ? $service->scheduling->schedule_time : '' }}"/> 
                                        </div>
                                        <div style="width: 100px;" class="input-group-append mx-2">
                                            <select name="schedule_type" class="form-control" data-toggle="select">
                                                <option value="1" {{ old('schedule_type', isset($service->scheduling->schedule_type) && $service->scheduling->schedule_type == 1 ? 'selected' : '' ) }}>
                                                    {{ __('Days') }}
                                                </option>
                                                <option value="2" {{ old('schedule_type', isset($service->scheduling->schedule_type) && $service->scheduling->schedule_type == 2 ? 'selected' : '' ) }}>
                                                    {{ __('Hours') }}
                                                </option>
                                                <option value="3" {{ old('schedule_type', isset($service->scheduling->schedule_type) && $service->scheduling->schedule_type == 3 ? 'selected' : '' ) }}>
                                                    {{ __('Minutes') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                  <div class="check-options d-flex align-items-center mt-2 col-12 px-0">
                                    <input @checked(isset($service->scheduling->indefinitely) && $service->scheduling->indefinitely === 2) id="scheduleType2" class="mr-2" type="radio" name="indefinitely" value="2">
                                    <label for="scheduleType2" class="check-styles px-1">Whitin a date range</label>
                                    <div @class([
                                            'd-flex' => isset($service->scheduling->indefinitely) && $service->scheduling->indefinitely === 2,
                                            'd-none' => !isset($service->scheduling->indefinitely) || isset($service->scheduling->indefinitely) && $service->scheduling->indefinitely !== 2,
                                            'div-date-schedule', 'col-md-9',
                                        ])>
                                        <div class="start col-lg-6">
                                            <div class="form-group m-0">
                                                <div class="flatpickr">
                                                    <input type="datetime-local" name="schedule_start" required id="start"
                                                        class="form-control m-0" placeholder="Choose start date"
                                                        data-toggle="flatpickr" data-flatpickr-min-date="today"
                                                        data-flatpickr-enable-time="true"
                                                        data-flatpickr-alt-format="F j, Y at H:i"
                                                        data-flatpickr-date-format="Y-m-d H:i" value={{ old('schedule_start', isset($service->scheduling->schedule_start) && $service->scheduling->schedule_start ? $service->scheduling->schedule_start : '')}}>
                                                    <i class="fa fa-calendar-alt p-0"></i>
                                                </div>
        
                                                <x-input-error class="mt-2" :messages="$errors->get('schedule_start')" />
                                            </div>
                                        </div>
                                        <div class="end col-lg-6">
                                            <div class="form-group m-0">
                                                <div class="flatpickr">
                                                    <input type="datetime-local" name="schedule_end" required id="end"
                                                        class="form-control m-0" placeholder="Choose closing date"
                                                        data-toggle="flatpickr" data-flatpickr-enable-time="true"
                                                        data-flatpickr-alt-format="F j, Y at H:i"
                                                        data-flatpickr-date-format="Y-m-d H:i"
                                                        value={{ old('schedule_end', isset($service->scheduling->schedule_end) &&  $service->scheduling->schedule_end ? $service->scheduling->schedule_end : '') }}>
                                                    <i class="fa fa-calendar-alt p-0"></i>
                                                </div>
                                                <x-input-error class="mt-2" :messages="$errors->get('schedule_end')" />
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="check-options d-flex align-items-center col-12 px-0 mt-3">
                                    <input @checked(isset($service->scheduling->indefinitely) && $service->scheduling->indefinitely === 3) id="indefinitely" class="mr-2" type="radio" value="3" name="indefinitely">
                                    <label for="indefinitely" class="check-styles px-1">Indefinitely into the future</label>
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
</style>

<script>
    const scheduleInput1 = document.querySelector('#scheduleType1')
    const scheduleInput2 = document.querySelector('#scheduleType2')
    const scheduleInput3 = document.querySelector('#indefinitely')
    const inputAfter = document.querySelector('#after')
    const inputBefore = document.querySelector('#before')
    const selectAfter = document.querySelector('#selectAfter')
    const selectBefore = document.querySelector('#selectBefore')
    const timeBefore = document.querySelector('#when_time_before')
    const timeAfter = document.querySelector('#when_time_after')
    const divTypeDate = document.querySelector('.div-date-schedule')
    var inputStart = document.querySelector('input[name="schedule_start"]')
    var inputEnd = document.querySelector('input[name="schedule_end"]')
    var scheduleTime = document.querySelector('input[name="schedule_time"]')
    var scheduleType = document.querySelector('select[name="schedule_type"]')

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
        if(!scheduleInput1.checked) {
            scheduleTime.disabled = true
            scheduleTime.value = ''
            scheduleType.disabled = true
        }
        if(!scheduleInput2.checked) {
            inputStart.disabled = true
            inputEnd.disabled = true
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
    scheduleInput2.addEventListener('change', () => {
        divTypeDate.classList.replace('d-none', 'd-flex')
        inputStart.disabled = false
        inputEnd.disabled = false
        scheduleTime.disabled = true
        scheduleTime.value = ''
        scheduleType.disabled = true
        scheduleInput1.disabled = false
        scheduleInput3.value = ''
    })

    scheduleInput1.addEventListener('change', () => {
        divTypeDate.classList.replace('d-flex', 'd-none')
        inputStart.disabled = true
        inputEnd.disabled = true
        inputStart.value = ''
        inputEnd.value = ''
        scheduleTime.disabled = false
        scheduleType.disabled = false
        scheduleInput1.disabled = false
        scheduleInput3.value = ''
    })

    scheduleInput3.addEventListener('change', () => {
        divTypeDate.classList.replace('d-flex', 'd-none')
        inputStart.disabled = true
        inputEnd.disabled = true
        inputStart.value = ''
        inputEnd.value = ''
        scheduleTime.disabled = true
        scheduleTime.value = '';
        scheduleType.disabled = true
        scheduleInput1.disabled = false
        scheduleInput3.disabled = false
    })
</script>