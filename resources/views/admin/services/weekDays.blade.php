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
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif
        <div class="container-fluid page__container">
          <div class="card card-form">
              <div class="row no-gutters">
                  <div class="col-12 card-form__body card-body">
                      <form method="POST" action="{{ route('weekday.update', $service->id) }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="row justify-content-center">

                                <div class="col-lg-12">
                                    <div class="title-forms-defaults">
                                        <h3>Days of the week</h3>
                                        <p class="info-label">Choose times and days of the week with availability. Don't worry, you can change specific days later if you need to.</p>
                                    </div>
                                </div>
                                @foreach ($daysOfWeek as $key => $dayOfWeek)
                                    <div array-key="{{$key}}" class="col-12 d-flex flex-wrap weekDayBorder test">
                                        <div class="d-flex align-items-center weekDay w-100 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                @if(in_array($key, $weekdayValues))
                                                    <input class="day-checkbox" type="checkbox" value="{{$key}}" @checked(true) name="weekday[]" id="weekday{{$key}}">
                                                @else
                                                    <input class="day-checkbox" type="checkbox" value="{{$key}}" name="weekday[]" id="weekday{{$key}}">
                                                @endif
                                                <label for="weekday{{$key}}">{{$dayOfWeek}}</label>
                                            </div>
                                            <div
                                                @class([
                                                    'd-block' => in_array($key, $weekdayValues),
                                                    'd-none' => !in_array($key, $weekdayValues)
                                                ])>
                                                <i class="icon-plus" style="font-size:30px;font-style: normal;line-height: 0;font-weight: 300;">+</i>
                                            </div>
                                        </div>

                                        @foreach ($weekDays as $weekDay)
                                            @if($key == $weekDay->weekday)
                                                @foreach ($weekDay->timedays as $timeday)
                                                    <div
                                                        @class([
                                                            'times','mt-2', 'mr-3',
                                                            'd-flex' => in_array($key, $weekdayValues),
                                                            'd-none' => !in_array($key, $weekdayValues)
                                                        ])>
                                                        
                                                        <div class="startTime">
                                                            <label class="p-0 d-flex flex-wrap label-start-end" for="start_time">Start*</label>
                                                            <input type="time" id="start_time" value="{{$timeday->start}}" name="start_time[{{$key}}][]" />
                                                        </div>
                                                        <div class="endTime mx-2">
                                                            <label class="p-0 d-flex flex-wrap label-start-end" for="end_time">End*</label>
                                                            <div class="d-flex align-items-center">
                                                                <input type="time" id="end_time" value="{{$timeday->end}}" name="end_time[{{$key}}][]"/>
                                                                <div><i class="material-icons icon-delete icon-del-weektime mx-1" onclick="removeParent(this)">delete</i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach

                                <div class="row mt-3">
                                    <a style="color:#333;" href="{{ route('services.index') }}"
                                    class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Cancel') }}</a>
                                    <x-success-button>{{ __('Next') }}</x-success-button>
                                </div>
                          </div> <!-- Final da Row -->
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
</x-app-layout>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const dayCheckboxes = document.querySelectorAll('.day-checkbox');

    dayCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function() {
            const divFather = checkbox.parentNode.parentNode.parentNode
            const iconsDiv = checkbox.parentNode.parentNode.lastElementChild
            var allTimes = divFather.querySelectorAll('.times')
            let arrayKay = divFather.getAttribute('array-key')

            let divContent = document.createElement("div")
            divContent.classList.add("d-flex", "times", "mt-2", "mr-3")
            divContent.innerHTML = `
            <div><i class="material-icons icon-delete mt-2" onclick="removeParent(this)">delete</i></div>
            <div class="startTime">
                <label class="p-0 d-flex flex-wrap" for="start_time1">Start*</label>
                <input type="time" id="start_time" name="start_time[${arrayKay}][]" required />
            </div>
            <div class="endTime mx-2">
                <label class="p-0 d-flex flex-wrap" for="end_time1">End*</label>
                <input type="time" id="end_time" name="end_time[${arrayKay}][]" required />
            </div>
            `
            
            if (this.checked) {
                allTimes.forEach(function(element) {
                    element.classList.replace("d-none", "d-flex");
                });
                iconsDiv.classList.replace("d-none", "d-flex");
                if(allTimes.length == 0) {
                    divFather.insertBefore(divContent, null)
                }
            }
            else {
                allTimes.forEach(function(element) {
                    const inputs = element.querySelectorAll('input');
                    inputs.forEach(function(input) {
                        input.value = ''
                    });
                    element.classList.replace("d-flex", "d-none");
                    if(allTimes[element] != 1) {
                        element.remove()
                    }
                });
                iconsDiv.classList.replace("d-block", "d-none");
            }
        });
    });
});
function removeParent(button) {
    button.parentNode.parentNode.parentNode.parentNode.remove();
}
function newInputTime() {
    const divFather = this.parentNode.parentNode.parentNode
    let arrayKay = divFather.getAttribute('array-key');
    let divContent = document.createElement("div")
    
    divContent.classList.add("d-flex", "times", "mt-2", "mr-3")
    divContent.innerHTML = `
    <div class="startTime">
        <label class="p-0 d-flex flex-wrap label-start-end" for="start_time[${arrayKay}][]">Start*</label>
        <input type="time" id="start_time" name="start_time[${arrayKay}][]" required />
    </div>
    <div class="endTime mx-2">
        <label class="p-0 d-flex flex-wrap label-start-end" for="end_time[${arrayKay}][]">End*</label>
        <div class="d-flex align-items-center">
            <input type="time" id="end_time" name="end_time[${arrayKay}][]" required />
            <div><i class="material-icons icon-delete icon-del-weektime mx-1" onclick="removeParent(this)">delete</i></div>
        </div>
    </div>
    `
    divFather.insertBefore(divContent, null)
}
const iconPlus = document.querySelectorAll('.icon-plus')
iconPlus.forEach( (element) => element.addEventListener('click', newInputTime))
</script>
<style>
    .weekDayBorder {
        border-bottom:1px solid #e5e5e5;
        padding: 20px 0px 20px 0px;
    }
    .weekDay label {
        font-size: 18px !important;
        font-weight: 400 !important;
        text-transform: none !important;
        margin-left: 10px !important;
        color: #112b4a !important;
    }
    .weekDay input {
        -webkit-appearance: none;
        background: white;
        border: 1.85px solid #EBEBEB;
        border-radius: 4px;
        width: 20px;
        height: 20px;
        position: relative;
    }
    .label-start-end {
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        color: #7f7f7f;
        margin: 0 !important;
    }
    .weekDay input:checked::before {
        content: '\2713';
        position: absolute;
        width: 100%;
        top: 0;
        height: 100%;
        left: 0;
        font-size: 16px;
        color: #fff;
        background-color: #7b9a6c;
        border-radius: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .times label {
        font-size: 12px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        color: #939FAD;
        margin:0;
    }
    input[type="time"] {
        border: 1px solid #f1f1f1;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 300;
    }
    .icon-del-weektime {
        font-size: 20px !important;
        padding: 5px;
    }
</style>